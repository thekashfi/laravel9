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
                'hasCategory' => Category::query()->visible()->exists(),
                'hasFile' => File::query()->active()->exists(),
                'hasPackage' => Package::query()->active()->exists(),
            ];
        });
        return $data ? ( $data[$index] ?? null  ) : $data;
    }
    public function home()
    {
        $categories = Category::visible()->orderByDesc('order')->latest()->get();
        $packages = Package::query()->orderByDesc('order')->active()->latest()->limit(8)->get();
        return view('home', compact('categories' , 'packages'));
    }

    public function contract($contract)
    {
        $contract = Contract::whereSlug($contract)->active()->firstOrFail();
        return view('contract', compact('contract'));
    }
    public function package($package_slug)
    {
        $package = Package::whereSlug($package_slug)->active()->with('contracts','files')->firstOrFail();

        $items = [];
        foreach($package->contracts as $item){
            $category = $item->packageCategory();
            if ( ! isset($items[$category->id]) )
                $items[$category->id] = [
                    'category' => $category,
                    'sort' => $category->order,
                    'contracts' => [],
                    'files' => [],
                    'count' => 0,
                    'count_contracts' => 0,
                    'count_files' => 0,
                ];
            $items[$category->id]['contracts'][] = $item ;
            $items[$category->id]['count_contracts']++;
            $items[$category->id]['count']++;
        }
        foreach($package->files as $item){
            $category = $item->packageCategory();
            if ( ! isset($items[$category->id]) )
                $items[$category->id] = [
                    'category' => $category,
                    'sort' => $category->order,
                    'contracts' => [],
                    'files' => [],
                    'count' => 0,
                    'count_contracts' => 0,
                    'count_files' => 0,
                ];
            $items[$category->id]['files'][] = $item ;
            $items[$category->id]['count_files']++;
            $items[$category->id]['count']++;
        }
        usort($items, function($a, $b) {
            return $b['sort'] - $a['sort'];
        });
        foreach($items as $category_id => $item){
            usort($items[$category_id]['contracts'], function($a, $b) {
                return $b->order - $a->order;
            });
            usort($items[$category_id]['files'], function($a, $b) {
                return $b->order - $a->order;
            });
        }

        return view('package', compact('package' , 'items'));
    }

    public function file($file_slug)
    {
        $file = File::whereSlug($file_slug)->active()->firstOrFail();
        return view('file', compact('file'));
    }

    public function contracts($category)
    {
        $result = cache()->remember('contracts_page_'.$category , 15 * 60 , function () use ($category){
            $contracts = Contract::query()->orderByDesc('order')->latest()->active();
            if (strtolower($category) != "all") {
                $category = Category::whereSlug($category)->firstOrFail();
                $contracts = $contracts->whereHas('categories' , function ($q) use($category){
                    $q->where('id',$category->id);
                });
            }
            $contracts = $contracts->get();
            return compact('contracts', 'category');
        });
        return view('contracts', $result );
    }


    public function packages($category)
    {
        $result = cache()->remember('packages_page_'.$category , 15 * 60 , function () use ($category){
            $packages = Package::query()->orderByDesc('order')->latest()->active();
            if (strtolower($category) != "all") {
                $category = Category::whereSlug($category)->firstOrFail();
                $packages = $packages->whereHas('categories' , function ($q) use($category){
                    $q->where('id',$category->id);
                });
            }
            $packages = $packages->get();
            return compact('packages', 'category');
        });

        return view('packages', $result);
    }

    public function files($category)
    {
        $result = cache()->remember('files_page_'.$category , 15 * 60 , function () use ($category){
            $files = File::query()->orderByDesc('order')->latest()->active();
            if (strtolower($category) != "all") {
                $category = Category::whereSlug($category)->firstOrFail();
                $files = $files->whereHas('categories' , function ($q) use($category){
                    $q->where('id',$category->id);
                });
            }
            $files = $files->get();
            return compact('files', 'category');
        });
        return view('files', $result);
    }
    public function category($category)
    {
        $category = Category::whereSlug($category)->visible()->firstOrFail();
        $result = cache()->remember('category_page_'.$category->id , 15 * 60 , function () use ($category){
            $contracts = $category->contracts()->orderByDesc('order')->latest()->limit(8)->get();
            $files = $category->files()->orderByDesc('order')->latest()->limit(8)->get();
            $packages = $category->packages()->orderByDesc('order')->latest()->limit(8)->get();
            return compact('files', 'contracts' , 'packages');
        });
        $result['category'] = $category;
        return view('category', $result);
    }

    public static function Mpdf_main_file_line_26125($html) {
        $alphabet = "??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??.??";
        $alphabetInsert = "??.??.??.??.??.??.??.??";
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
        $alphabet = "??.??.??.??.??.??.??";
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
        $categories = Category::withCount('packages' , 'contracts' , 'files')->visible()->get();
        $contracts = Contract::active()->get();
        $files = File::active()->get();
        $packages = Package::active()->get();

        return response()
            ->view('sitemap', compact('categories', 'contracts', 'files', 'packages'))
            ->header('Content-Type', 'text/xml');
    }
}
