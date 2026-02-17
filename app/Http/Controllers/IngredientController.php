<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Inventory;
use App\Models\Supply;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    public function index(Request $request){
        // $ingredients = ingredient::findOrFail()->get();
        $ingredients = Ingredient::with('inventory')->with('suppliers')->get();

        if($ingredients->isEmpty()){
            return response()->json([
                'message' => 'no se encontraron ingredient',
                ],400);
        }

        return response()->json([
            'message' => 'Todos los ingredients aquí',
            'data' => $ingredients
        ],200);
    }

    public function show($id){
        $ingredient = Ingredient::with('inventory')->with('suppliers')->find($id);

        if(!$ingredient){
            return response()->json([
                'message' => 'no se encontro al ingredient',
                ],400);
        }


        return response()->json([
            'message' => 'datos del ingredient',
            'data' => $ingredient
        ],200);
    }

    public function store(Request $request){

    $request->validate([
        "name" => "string|required",
        "description" => "string|required",
        "price" => "required",
        "stock" => "required"
    ]);
    try{
        return DB::transaction(function () use ($request){

            
            $supplier = 1;
            $ingredient = Ingredient::create([
                'supplier_id' => $supplier,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,          
            ]);
            $ingredient->save();

            $inventory = Inventory::create([
                'ingredient_id' => $ingredient->ingredient_id,
                'stock' => $request->stock
            ]);
            $inventory->save();

            return response()->json([
                "data" => $ingredient
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
    $ingredient = Ingredient::with('inventory')->with('suppliers')->find($id);
        $request->validate([
        "name" => "string|required",
        "description" => "string|required",
        "price" => "required",
        "stock" => "required"
    ]);
    try {
        return DB::transaction(function() use ($request, $ingredient){
            $supplier = 1;
            $ingredient->inventory->update($request->only(['stock'])); 

            $ingredient->update($request->only(['name', 'description', 'price']));

        });
    } catch (\Exception $e){
        return back()->withInput()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
    }
    }
public function destroy($id){
    $ingredient = Ingredient::with('inventory')->with('suppliers')->find($id);
    $ingredient->inventory->delete();
    $ingredient->delete();
    
    }
}
