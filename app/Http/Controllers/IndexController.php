<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\Fillable;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

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
        return view('payments');
    }

    public function form($contract_slug)
    {
        $fillables = $this->get_fillables($contract_slug);

        return view('form', compact('contract_slug', 'fillables'));
    }

    public function download(Request $request , $contract){
        // validation fillables form
        $fillables = $this->get_fillables($contract);

        $rules = [];
        $names = [];
        foreach ($fillables as $fillable){
            if ($fillable->rules != null) {
                $rules['custom.' . $fillable->id] = $fillable->rules;
                $names['custom.' . $fillable->id] = $fillable->name;
            }
        }

        $this->validate($request, $rules , [] , $names );

        // response download generated pdf
        return $this->generate_pdf('<h1 style="direction: rtl;">فو بار باز</h1>');
    }

    private function get_fillables($contract_slug)
    {
        $contract = Contract::whereSlug($contract_slug)->firstOrFail();

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
    {$pdf = new Mpdf(['format' => 'LETTER', 'orientation' => 'P', 'mode' => 'utf-8',
        'fontDir' =>  public_path('fonts'),
        'fontdata' => [ // lowercase letters only in font key
            'vazir' => [
                'I' => 'Vazirmatn-Bold.ttf',
                'R' => 'Vazirmatn-Light.ttf',
            ]
        ],
        'default_font' => 'vazir'
    ]);

        $pdf->SetProtection(['print'], null, null, 128);
        $pdf->autoScriptToLang = true;
        $pdf->autoLangToFont = true;
        $pdf->writeHTML($html);
        return $pdf->Output();
    }
}
