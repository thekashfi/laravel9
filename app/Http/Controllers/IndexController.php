<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\File;
use App\Models\Package;

class IndexController extends Controller
{
    public static function view($index = null ){
        $data =  cache()->remember('viewOptions' , 15 * 60 , function (){
            return [
                'hasContract' => Contract::query()->active()->exists(),
                'hasCategory' => Category::query()->exists(),
                'hasFile' => File::query()->active()->exists(),
                'hasPackage' => Package::query()->active()->exists(),
            ];
        });
        return $data ? ( $data[$index] ?? null  ) : $data;
    }
    public function home()
    {
        $categories = Category::get();
        $packages = Package::query()->active()->latest()->limit(8)->get();
        return view('home', compact('categories' , 'packages'));
    }

    public function contract($contract)
    {
        $contract = Contract::whereSlug($contract)->active()->firstOrFail();
        return view('contract', compact('contract'));
    }
    public function package($package_slug)
    {
        $package = Package::whereSlug($package_slug)->active()->firstOrFail();
        return view('package', compact('package'));
    }

    public function file($file_slug)
    {
        $file = File::whereSlug($file_slug)->active()->firstOrFail();
        return view('file', compact('file'));
    }

    public function contracts($category)
    {
        $result = cache()->remember('contracts_page_'.$category , 15 * 60 , function () use ($category){
            $contracts = Contract::query()->latest()->active();
            if (strtolower($category) != "all") {
                $category = Category::whereSlug($category)->firstOrFail();
                $contracts = $contracts->where('category_id', $category->id);
            }
            $contracts = $contracts->get();
            return compact('contracts', 'category');
        });
        return view('contracts', $result );
    }


    public function packages($category)
    {
        $result = cache()->remember('packages_page_'.$category , 15 * 60 , function () use ($category){
            $packages = Package::query()->latest()->active();
            if (strtolower($category) != "all") {
                $category = Category::whereSlug($category)->firstOrFail();
                $packages = $packages->where('category_id', $category->id);
            }
            $packages = $packages->get();
            return compact('packages', 'category');
        });

        return view('packages', $result);
    }

    public function files($category)
    {
        $result = cache()->remember('files_page_'.$category , 15 * 60 , function () use ($category){
            $files = File::query()->latest()->active();
            if (strtolower($category) != "all") {
                $category = Category::whereSlug($category)->firstOrFail();
                $files = $files->where('category_id', $category->id);
            }
            $files = $files->get();
            return compact('files', 'category');
        });
        return view('files', $result);
    }
    public function category($category)
    {
        $category = Category::whereSlug($category)->firstOrFail();
        $result = cache()->remember('category_page_'.$category->id , 15 * 60 , function () use ($category){
            $contracts = $category->contracts()->latest()->limit(8)->get();
            $files = $category->files()->latest()->limit(8)->get();
            $packages = $category->packages()->latest()->limit(8)->get();
            return compact('files', 'contracts' , 'packages');
        });
        $result['category'] = $category;
        return view('category', $result);
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

    public function sitemap()
    {
        $categories = Category::withCount('packages' , 'contracts' , 'files')->get();
        $contracts = Contract::active()->get();
        $files = File::active()->get();
        $packages = Package::active()->get();

        return response()
            ->view('sitemap', compact('categories', 'contracts', 'files', 'packages'))
            ->header('Content-Type', 'text/xml');
    }
}
