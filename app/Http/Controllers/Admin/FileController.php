<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\File;
use App\Models\Fillable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function index()
    {
        $files = File::latest()->paginate(20);

        return view('admin.file_index', compact('files'));
    }

    public function create()
    {
        $file = new File();
        $categories = Category::get();

        return view('admin.file_edit', compact('file', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:files,slug',
            'category_id' => 'required',
            'price' => 'int',
            'file' => 'required|starts_with:/storage/private/',
        ]);

        $request->merge(['description' => str_replace('../../../files' , url('files') , $request->description)]);

        File::create($request->all());
        cache()->clear();

        return $this->flashBack();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $file = File::findOrFail($id);
        $categories = Category::get();

        return view('admin.file_edit', compact('file', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:files,slug,'.$id,
            'category_id' => 'required',
            'price' => 'int',
            'file' => 'required|starts_with:/storage/private/',
        ]);

        $request->merge(['description' => str_replace('../../../files' , url('files') , $request->description)]);

        File::findOrFail($id)->update($request->all());
        cache()->clear();

        return $this->flashBack();
    }

    public function destroy($id)
    {
        File::findOrFail($id)->delete();
        cache()->clear();

        return $this->flashBack();
    }
}
