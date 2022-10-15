<?php

namespace App\Http\Controllers;

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

class IndexController extends Controller
{
    public function home()
    {
        $categories = Category::get();

        return view('home', compact('categories'));
    }

    public function contract($contract)
    {
        $contract = Contract::whereSlug($contract)->firstOrFail();

        return view('contract', compact('contract'));
    }

    public function contracts($category = null)
    {
        $contracts = new Contract;
        if ($category) {
            $category = Category::whereSlug($category)->firstOrFail();
            $contracts = $contracts->where('category_id', $category->id);
        }
        $contracts = $contracts->get();
        $category = $category ?? null;

        return view('contracts', compact('contracts', 'category'));
    }

    public function payments()
    {
        $orders = Order::with('contract')->whereUserId(auth()->id())->whereIsPaid(1)->latest()->get();

        return view('payments', compact('orders'));
    }

    public function payments_history()
    {
        $orders = Order::with('contract')->whereUserId(auth()->id())->latest()->get();

        return view('payments_history', compact('orders'));
    }

    public function form($uuid)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        $contract = Contract::findOrFail($order->contract_id);

        Gate::authorize('use-order', $order);

        // if contract has empty text => show form. else => download
        if (empty($order->contract_text)) {
            $fillables = $this->get_fillables($contract);
            return view('form', compact('order', 'fillables'));
        } else
            return $this->download($order->uuid);
    }

    public function generate(Request $request, $uuid)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        $contract = Contract::findOrFail($order->contract_id);

        $fillables = $this->get_fillables($contract);

        // validation fillables form
        if (! empty($order->contract_text))
            return abort(403, 'شما قبلا این قرارداد را ساخته اید.');

        $fillables = $this->get_fillables($contract);

        foreach ($fillables as $fillable) {
            if ($fillable->rules != null) {
                $rules['custom.' . $fillable->id] = $fillable->rules;
                $names['custom.' . $fillable->id] = "«{$fillable->name}»";
            }
        }
        $this->validate($request, $rules ?? [], [] , $names ?? []);

        //generate html for pdf
        foreach ($fillables as $fillable) {
            $inputs[] = "[[$fillable->id:<span style=\"color: #6073df;\">$fillable->name</span>]]";
            $answers[] = strip_tags($request->input("custom.$fillable->id")) ?? '';
        }

        $html = str_replace($inputs, $answers, $contract->text);
        $order->update(['contract_text' => $html]);

        return $this->download($order->uuid);
    }

    private function download($uuid)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        return $this->generate_pdf($order->contract_text);
    }

    public function buy(Request $request , $contract_slug)
    {
        $contract = Contract::whereSlug($contract_slug)->firstOrFail();
        try{
            DB::beginTransaction();
            $order = new Order();
            $order->uuid = \Illuminate\Support\Str::uuid();
            $order->user_id = auth()->id();
            $order->contract_id = $contract->id;
            $order->contract_name = $contract->name;
            $order->amount = $contract->price;
            $order->ip = $request->ip();
            $order->is_paid = 2;
            $order->save();
            $invoice = new Invoice;
            $invoice->amount( $contract->price );
            $invoice->detail('Title', $contract->name);
            return Payment::callbackUrl(route('callback', $order->uuid))->purchase($invoice, function ($driver, $transactionId) use ($order) {
                $order->trans1 = $transactionId;
                $order->save();
                DB::commit();
            })->pay()->render();
        } catch (\Exception $exception){
            return redirect()->route('contract',$contract_slug)->withErrors([
                "لطفا مجددا تلاش نمایید!"
            ]);
        }
    }

    public function callback(Request $request , $uuid)
    {
        $order = Order::whereUuid($uuid)->firstOrFail();
        try {
            if ($order->is_paid == 2) {
                DB::beginTransaction();
                $receipt = Payment::amount($order->amount)->transactionId($request->Authority)->verify();
                $order->trans2 = $receipt->getReferenceId();
                $order->result = "پرداخت تکمیل و با موفقیت انجام شده است";
                $order->is_paid = 1;
                $order->save();
                DB::commit();
                return redirect()->route('payments')->with('flash', 'پرداخت با موفقیت انجام شد.');
            }
            return redirect()->route('payments')->withErrors('فاکتور مد نظر قبلا پرداخت شده است!');
        } catch (InvalidPaymentException | \Exception $exception) {
            DB::rollBack();
            $order->result = ( $order->result != null ? $order->result.PHP_EOL : '') .$exception->getMessage();
            $order->is_paid = 0;
            $order->save();
            return redirect()->route('payments')->withErrors($exception->getMessage());
        }
    }

    private function get_fillables($contract)
    {
        $matches = array();
        // preg_match("/\[\d+\:(.+)\]/", $contract->text, $matches);
        preg_match_all("/\[\[\d+\:([^\]])*\]\]/", $contract->text, $matches);

        foreach($matches[0] as $match) {
            $variable = $match;
            $variable = substr($variable, 0, strpos($variable, ":"));
            $variable = str_replace('[', '', $variable);
            if (is_numeric($variable))
                $fillables[] = (int) $variable;
        }

        return Fillable::query()->whereIn('id', $fillables ?? [])->get();
    }

    private function generate_pdf($html)
    {
        $pdf = new Mpdf(['format' => 'A4', 'orientation' => 'P', 'mode' => 'utf-8',
            'fontDir' =>  public_path('fonts'),
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

        $pdf->SetProtection(['print'], null, null, 128);
        $pdf->allow_charset_conversion = false;
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->writeHTML($html);
        return $pdf->Output();
    }


    public function orders(Request $request){
        $orders = Order::query()->latest()->when($request->has('q') , function ($query) use ($request){
            $query->where('trans1' , 'like' , $request->q )
                ->orWhere('contract_name' , 'like' , $request->q )
                ->orWhere('id'  , trim($request->q , '#') );
        })->paginate(50);

        return view('admin.orders_index' , compact('orders'));
    }
    public function admin_print(Request $request, $uuid){
        $order = Order::whereUuid($uuid)->firstOrFail();
        return view('admin.print' , compact('order'));
    }
}
