<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\File;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::withCount('contracts','files')->latest()->paginate(20);

        return view('admin.package_index', compact('packages'));
    }

    public function create()
    {
        $package = new Package();
        $categories = Category::get();
        $files = File::latest()->get();
        $contracts = Contract::latest()->get();

        return view('admin.package_edit', compact('package', 'categories' , 'files' , 'contracts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:packages,slug',
            'category_id' => 'required',
            'price' => 'int',
            'image' => 'nullable|image',
            'slogan1' => 'nullable|max:255',
            'slogan2' => 'nullable|max:255',
        ]);

        $request->merge(['description' => str_replace('../../../files' , url('files') , $request->description)]);

        $package = Package::create($request->all());
        $package->categories()->sync($request->category_id);
        $package->contracts()->sync($request->contracts);
        $package->files()->sync($request->file_ids);
        cache()->clear();
        return $this->flashBack();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $categories = Category::orderByDesc('order')->get();
        $files = File::latest()->get();
        $contracts = Contract::latest()->get();

        return view('admin.package_edit', compact('package', 'categories' , 'files' , 'contracts'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:packages,slug,'.$id,
            'category_id' => 'required',
            'price' => 'int',
        ]);

        $request->merge(['description' => str_replace('../../../files' , url('files') , $request->description)]);

        $package = Package::findOrFail($id);
        $package->update($request->all());
        $package->categories()->sync($request->category_id);
        $package->contracts()->sync($request->contracts);
        $package->files()->sync($request->file_ids);
        cache()->clear();
        return $this->flashBack();
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        $package->categories()->detach();
        $package->contracts()->detach();
        $package->files()->detach();
        cache()->clear();

        return $this->flashBack();
    }
}
