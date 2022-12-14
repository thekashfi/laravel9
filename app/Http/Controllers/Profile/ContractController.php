<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Fillable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Mpdf\Mpdf;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class ContractController extends Controller
{

    public function form($uuid , $id)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        Gate::authorize('use-order', $order); // check if order belongs to user && paid

        $item = $order->items()->where('item_type' , Contract::class)->findOrFail($id);
        $contract = Contract::findOrFail($item->item_id);
        // if contract has empty text => show form. else => download
        //if (empty($item->item_text)) {
        $fillables = $this->get_fillables($contract);
        if ( $fillables->count()  == 0 and ! env('CAN_EDIT_CONTRACT' , false))
            return redirect()->route('generate', [$uuid , $id]);
        if ( $fillables->count()  == 0 and env('CAN_EDIT_CONTRACT' , false))
            return redirect()->route('edit.contract', [$uuid , $id]);
        session()->flashInput(request()->input()); // olds of redirected back from form_confirmation
        return view('form', compact('order','item', 'fillables'));
        //} else
        //    return $this->generate_pdf($contract->name, $item->item_text);
    }

    public function editForm(Request $request , $uuid , $id){
        if ( ! env('CAN_EDIT_CONTRACT' , false) )
            abort(404);
        $order = Order::whereUuid($uuid)->firstOrFail();
        Gate::authorize('use-order', $order); // check if order belongs to user && paid
        $item = $order->items()->where('item_type' , Contract::class)->findOrFail($id);
        $contract = Contract::findOrFail($item->item_id);
        $fillables = $this->get_fillables($contract);
        $html = $contract->text;
        if ( $fillables->count()  ) {
            foreach ($fillables as $fillable) {
                if ($fillable->rules != null) {
                    $rules['custom.' . $fillable->id] = $fillable->rules;
                    $names['custom.' . $fillable->id] = "??{$fillable->name}??";
                }
            }
            $this->validate($request, $rules ?? [], [], $names ?? []);

            //generate html for pdf
            foreach ($fillables as $fillable) {
                $inputs[] = "[[$fillable->id:<span style=\"color: #6073df;\">$fillable->name</span>]]";
                $answers[] = nl2br(strip_tags($request->input("custom.$fillable->id"))) ?? '';
            }
            $html = str_replace($inputs, $answers, $html);
        }
        $values = ($request->has('custom') and isset($request->all('custom')['custom'])) ? $request->all('custom')['custom'] : [];
        session()->flashInput(request()->input()); // olds of redirected back from form_confirmation
        return view('editForm', compact('order' , 'item', 'fillables', 'values' , 'html'));
    }


    public function form_confirmation(Request $request, $uuid,$id)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        Gate::authorize('use-order', $order); // check if order belongs to user && paid
        $item = $order->items()->where('item_type' , Contract::class)->findOrFail($id);
        $contract = Contract::findOrFail($item->item_id);

        //if (empty($item->item_text)) {
        if ( ! env('CAN_EDIT_CONTRACT' , false) ) {
            $fillables = $this->get_fillables($contract);
            $values = ($request->has('custom') and isset($request->all('custom')['custom'])) ? $request->all('custom')['custom'] : [];
            $html = "";
        } else {
            $fillables = [];
            $values = [];
            $html = $request->html;
        }
        return view('form_confirmation', compact('order' , 'item', 'fillables', 'values' , 'html'));
        //} else
        //    return $this->generate_pdf($contract->name, $item->item_text);
    }

    public function download($uuid , $id)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        Gate::authorize('use-order', $order); // check if order belongs to user && paid
        $item = $order->items()->where('item_type' , Contract::class)->findOrFail($id);
        if (empty($item->item_text))
            return redirect()->route('form', [$uuid , $id]);

        return $this->generate_pdf($item->item_name, $item->item_text);
    }


    public function generate(Request $request, $uuid , $id)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        Gate::authorize('use-order', $order); // check if order belongs to user && paid

        $item = $order->items()->where('item_type' , Contract::class)->findOrFail($id);
        $contract = Contract::findOrFail($item->item_id);
        //if (!empty($item->item_text))
        //    return $this->generate_pdf($contract->name, $item->item_text);


        if ( ! env('CAN_EDIT_CONTRACT' , false) ) {
            // validation fillables form
            $fillables = $this->get_fillables($contract);
            $html = $contract->text;
            if ($fillables->count()) {
                foreach ($fillables as $fillable) {
                    if ($fillable->rules != null) {
                        $rules['custom.' . $fillable->id] = $fillable->rules;
                        $names['custom.' . $fillable->id] = "??{$fillable->name}??";
                    }
                }
                $this->validate($request, $rules ?? [], [], $names ?? []);

                //generate html for pdf
                foreach ($fillables as $fillable) {
                    $inputs[] = "[[$fillable->id:<span style=\"color: #6073df;\">$fillable->name</span>]]";
                    $answers[] = nl2br(strip_tags($request->input("custom.$fillable->id"))) ?? '';
                }

                $html = str_replace($inputs, $answers, $html);
            }
            $item->update(['item_text' => $html]);
        } else {
            $html = $request->html;
            $item->update(['item_text' => $html]);
        }

        return $this->generate_pdf($contract->name, $item->item_text);
    }

    private function get_fillables($contract)
    {
        $matches = array();
        // preg_match("/\[\d+\:(.+)\]/", $contract->text, $matches);
        preg_match_all("/\[\[\d+\:([^\]])*\]\]/", $contract->text, $matches);

        foreach ($matches[0] as $match) {
            $variable = $match;
            $variable = substr($variable, 0, strpos($variable, ":"));
            $variable = str_replace('[', '', $variable);
            if (is_numeric($variable))
                $fillables[] = (int)$variable;
        }

        return Fillable::query()->whereIn('id', $fillables ?? [])->get();
    }

    private function generate_pdf($name , $html)
    {
        $pdf = new Mpdf(['format' => 'A4', 'orientation' => 'P', 'mode' => 'utf-8',
            'fontDir' => public_path('fonts'),
            'fontdata' => [ // lowercase letters only in font key
                'iransansweb' => [
                    'R' => 'IRANSansWeb.ttf',
                    'useOTL' => 0x80,
                    'useKashida' => 75,
                ]
            ],
            'default_font' => 'iransansweb'
        ]);
        $pdf->useAdobeCJK = true;
        //         $spam = 'lksfdj  k f dslkhf lksdfj kshf utyd ytrsa warx gfv kjhb m l , plk jpo asdf khsdu fslksfdj  k f dslkhf lksdfj kshf utyd ytrsa warx gfv kjhb m l , plk jpo asdf khsdu fslksfdj  k f dslkhf lksdfj kshf utyd ytrsa warx gfv kjhb m l , plk jpo asdf khsdu fslksfdj  k f dslkhf lksdfj kshf utyd ytrsa warx gfv kjhb m l , plk jpo asdf khsdu fslksfdj  k f dslkhf lksdfj kshf utyd ytrsa warx gfv kjhb m l , plk jpo asdf khsdu fslksfdj  k f dslkhf lksdfj kshf utyd ytrsa warx gfv kjhb m l , plk jpo asdf khsdu fs';
        //         $hash = '<div style=\'color: white; width:0; height:0; overflow: hidden; line-height:1px; padding:0; margin: 0;
        // font-size: 1px; position: fixed; top: 0; right: 1px\'>1232222222222222222222222222222</div>';
        //         $html = str_replace('</p>', '</p>' . $hash, $html);
        $pdf->SetProtection(['print'], null, null, 128);
        $pdf->allow_charset_conversion = false;
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->SetTitle($name.' ['.config('app.name').']');
        $pdf->SetAuthor(config('app.name'));
        $pdf->SetCreator(config('app.name'));
        $pdf->writeHTML('<body style="position: relative">' . $html . '</body>');
        return $pdf->Output($name.' ['.config('app.name').'].pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }

}
