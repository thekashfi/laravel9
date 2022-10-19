<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Fillable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::latest()->paginate(20);

        return view('admin.contract_index', compact('contracts'));
    }

    public function create()
    {
        $contract = new Contract;
        $categories = Category::get();

        return view('admin.contract_edit', compact('contract', 'categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:contracts,slug',
            'text' => 'required',
            'category_id' => 'required',
            'price' => 'int',
        ]);

        $request->merge(['description' => str_replace('../../../files' , url('files') , $request->description)]);

        Contract::create($request->all());

        return $this->flashBack();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        $categories = Category::get();

        return view('admin.contract_edit', compact('contract', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:contracts,slug,'.$id,
            'category_id' => 'required',
            'text' => 'required',
            'price' => 'int',
        ]);

        $request->merge(['description' => str_replace('../../../files' , url('files') , $request->description)]);

        Contract::findOrFail($id)->update($request->all());

        return $this->flashBack();
    }

    public function destroy($id)
    {
        Contract::findOrFail($id)->delete();

        return $this->flashBack();
    }

    public function fillables(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'rules' => 'max:255',
            'type' => 'required',
        ]);
        // dd($request->options);

        $fillable = Fillable::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'rules' => $request->rules,
            'options' => json_encode(explode(PHP_EOL , $request->options))
        ]);

        $response = "[[{$fillable->id}:<span style='color: #6073DF'>{$fillable->name}</span>]]";

        return redirect()->back()->with('response', $response);
    }
}
