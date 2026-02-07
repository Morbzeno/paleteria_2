<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

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
        $ingredient = Ingredient::with('inventory')->with('suppliers')->findOrFail($id)->get();

        if($ingredient->isEmpty()){
            return response()->json([
                'message' => 'no se encontro al ingredient',
                ],400);
        }

        return response()->json([
            'message' => 'datos del ingredient',
            'data' => $ingredient
        ],200);
    }
}
