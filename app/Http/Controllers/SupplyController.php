<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supply;

class SupplyController extends Controller
{
    public function index(Request $request){
        // $supplys = supply::findOrFail()->get();
        $supplys = Supply::paginate(10);

        if($supplys->isEmpty()){
            return response()->json([
                'message' => 'no se encontraron supply',
                ],400);
        }

        return response()->json([
            'message' => 'Todos los supplys aquí',
            'data' => $supplys
        ],200);
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
        "phone_number" => "required",
        "last_supply" => "required"
    ]);
    try{
        return DB::transaction(function () use ($request){

            $supply = Supply::create([
                'phone_number' => $phone_number,
                'name' => $request->name,
                'description' => $request->description,
                'last_supply' => $request->last_supply,          
            ]);
            $supply->save();

            return response()->json([
                "data" => $supply
            ], 200);
        });
    } catch(\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar el registro',
                'error' => $e->getMessage()
            ], 500);
        }
    }
public function update(Request $request, $id){
    $supply = Supply::find($id);
        $request->validate([
        "name" => "string|required",
        "description" => "string|required",
        "phone_number" => "required",
        "last_supply" => "required"
    ]);
    try {
        return DB::transaction(function() use ($request, $supply){
            $supply->update($request);
        });
    } catch (\Exception $e){
        return back()->withInput()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
    }
    }
public function destroy($id){
    $supply = Supply::find($id);
    $supply->delete();
    }
}

