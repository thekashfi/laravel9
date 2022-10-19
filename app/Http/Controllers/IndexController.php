<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;

class IndexController extends Controller
{
    public function home()
    {
        $categories = Category::get();

        return view('home', compact('categories'));
    }

    public function contract($contract)
    {
        $contract = Contract::whereSlug($contract)->active()->firstOrFail();

        return view('contract', compact('contract'));
    }

    public function contracts($category = null)
    {
        $contracts = Contract::query()->active();
        if ($category) {
            $category = Category::whereSlug($category)->firstOrFail();
            $contracts = $contracts->where('category_id', $category->id);
        }
        $contracts = $contracts->get();

        return view('contracts', compact('contracts', 'category'));
    }

    public static function Mpdf_main_file_line_26125($html) {
        $alphabet = "ا.ب.پ.ت.ث.ج.چ.ح.خ.د.ذ.ر.ز.ژ.س.ش.ص.ض.ط.ظ.ع.غ.ف.ق.ک.گ.ل.م.ن.و.ه.ی";
        $alphabetInsert = "ع.غ.ف.ق.ب.پ.ت.ث";
        $persiansAlphabet = explode('.', $alphabet);
        $alphabetInsert = explode('.', $alphabetInsert);
        foreach ($persiansAlphabet as $i => $v) {
            $persiansAlphabet1[$i] = $v . ' ';
            $persiansRAlphabet[$i] = $v . '<span style=\'text-align: right;color: white; width:0; height:0; overflow: hidden; line-height:0px; padding:0; margin: 0;font-size: 1px; position: fixed; top: 0; right: 0px\'>';
            for ($it = 1; $it <= rand(3,4)    ; $it++)
                $persiansRAlphabet[$i] .= $alphabetInsert[rand(0, count($alphabetInsert) - 1 )];
            $persiansRAlphabet[$i] .= '</span> ';
        }
        $html = str_replace($persiansAlphabet1, $persiansRAlphabet, $html);
        $alphabet = "ا.د.ذ.ر.ز.ژ.و";
        $persiansAlphabet = explode('.', $alphabet);
        foreach ($persiansAlphabet as $i => $v) {
            $persiansAlphabet[$i] = $v;
            $persiansRAlphabet[$i] = $v . '<span style=\'text-align: right;color: white; width:0; height:0; overflow: hidden; line-height:0px; padding:0; margin: 0;font-size: 1px; position: fixed; top: 0; right: 0px\'>';
            for ($it = 1; $it <= 1; $it++)
                $persiansRAlphabet[$i] .= $alphabetInsert[rand(0, count($alphabetInsert) - 1 )];
            $persiansRAlphabet[$i] .= '</span>';
        }
        return str_replace($persiansAlphabet, $persiansRAlphabet, $html);
    }
}
