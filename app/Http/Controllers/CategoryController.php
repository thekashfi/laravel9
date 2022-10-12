<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('contracts')->paginate(20);

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
            'slug' => 'required|max:100|unique:categories,id',
            'in_menu' => 'boolean'
        ]);

        Category::create($request->all());

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
            'slug' => 'required|max:100|unique:categories,id,' . $id,
            'in_menu' => 'boolean'
        ]);

        Category::findOrfail($id)->update($request->all());

        return $this->flashBack();
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return $this->flashBack();
    }
}
