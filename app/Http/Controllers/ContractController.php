<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Fillable;
use Illuminate\Http\Request;

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
        return view('admin.contract_edit', compact('contract'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'text' => 'required',
            'price' => 'int',
        ]);

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

        return view('admin.contract_edit', compact('contract'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'text' => 'required',
            'price' => 'int',
        ]);

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
            'type' => 'required',
        ]);
        // dd($request->options);

        $fillable = Fillable::create([
            'name' => $request->name,
            'description' => $request->description,
            'rules' => $request->rules,
            'type' => $request->type,
            'options' => $request->options
        ]);

        $response = "[{$fillable->id}:<span style='color: #6073DF'>{$fillable->name}</span>]";

        return redirect()->back()->with('response', $response);
    }
}
