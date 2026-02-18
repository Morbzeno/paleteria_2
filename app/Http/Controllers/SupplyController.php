<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SupplyController extends Controller
{
    public function index(Request $request){
        // $supplys = supply::findOrFail()->get();
        $supplies = Supply::paginate(10);
        return view('supply.index', compact('supplies'));
    }

    public function show($id){
        $supply = Supply::find($id);

        if(!$supply){
            return response()->json([
                'message' => 'no se encontro al supply',
                ],400);
        }

        return response()->json([
            'message' => 'datos del supply',
            'data' => $supply
        ],200);
    }

    public function store(Request $request){

    $request->validate([
        "name" => "string|required",
        "description" => "string|required",
        "phone_number" => "required|string|unique:suppliers",
        "last_supply" => ""
    ]);
    try{
        return DB::transaction(function () use ($request){

            $supply = Supply::create([
                'phone_number' => $request->phone_number,
                'name' => $request->name,
                'description' => $request->description,
                'last_supply' => $request->last_supply,          
            ]);
            $supply->save();

            // return response()->json([
            //     "data" => $supply
            // ], 200);
            $supplies = Supply::paginate(10);
            return view('supply.index', compact('supplies'));
        });
    } catch(\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar el registro',
                'error' => $e->getMessage()
            ], 500);
        }
    }
public function create(){
    return view('supply.create');
}

public function update(Request $request, $id){
    $supply = Supply::find($id);
        $request->validate([
        "name" => "string|sometimes",
        "description" => "string|sometimes",
        Rule::unique('supplies', 'phone_number')->ignore($supply->supplier_id, 'supplier_id'),
        "last_supply" => "sometimes"
    ]);
    try {
        return DB::transaction(function() use ($request, $supply){
            $supply->update($request->only(['name', 'description',  'phone_number', 'last_supply']));
            return view('supply.edit', compact('supply'));
        });
    } catch (\Exception $e){
        return back()->withInput()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
    }
}
public function edit($id){
    $supply = Supply::find($id);
    return view('supply.edit', compact('supply'));
}

public function destroy($id){
    $supply = Supply::find($id);
    if (!$supply){
         return response()->json([
                'message' => 'Error al procesar el registro'
        ], 500);
    }
    $supply->delete();

    $supplies = Supply::paginate(10);
    return view('supply.index', compact('supplies'))->with('success', 'Proovedor eliminado correctamente.');

    }
}

