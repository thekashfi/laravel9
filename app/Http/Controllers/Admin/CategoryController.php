<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('contracts','files' , 'packages')->paginate(20);
        return view('admin.category_index', compact('categories'));
    }

    public function create()
    {
        $category = new Category;

        return view('admin.category_edit', compact('category'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'image' => 'required',
            'slug' => 'required|max:100|unique:categories,slug',
            'color' => 'required|max:7',
            'in_menu' => 'boolean',
        ]);

        Category::create($request->all());
        cache()->clear();
        return $this->flashBack(null, 'admin.category.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category_edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'image' => 'required',
            'slug' => 'required|max:100|unique:categories,slug,' . $id,
            'color' => 'required|max:7',
            'in_menu' => 'boolean',
        ]);

        Category::findOrfail($id)->update($request->all());
        cache()->clear();

        return $this->flashBack();
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ( $category->allContracts()->count() > 0 or $category->allFiles()->count() > 0 or $category->allPackages()->count() > 0 )
            return redirect()->back()->withErrors('دسته مورد نظر شامل قرارداد، پکیج یا فایل می باشد!');
        $category->delete();
        cache()->clear();
        return $this->flashBack();
    }
}
