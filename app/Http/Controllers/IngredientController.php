<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Inventory;
use App\Models\Supply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class IngredientController extends Controller
{
    public function index(Request $request){
        // $ingredients = ingredient::findOrFail()->get();
        $ingredients = Ingredient::with('inventory')->with('suppliers')->paginate(10);

        // if($ingredients->isEmpty()){
        //     return response()->json([
        //         'message' => 'no se encontraron ingredient',
        //         ],400);
        // }

        return view('ingredient.index', compact('ingredients'));
        // return response()->json([
        //     'message' => 'Todos los ingredients aquí',
        //     'data' => $ingredients
        // ],200);
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
public function store(Request $request) {
    $request->validate([
        "name" => "string|required",
        "description" => "string|required",
        "price" => "required",
        "stock" => "required",
        'image' => 'required|mimes:jpg,jpeg,png,gif',
        'video_path' => 'required|mimes:mp4'
    ]);

    try {
        DB::transaction(function () use ($request) {
            $ingredient = Ingredient::create([
                'supplier_id' => $request->supplier,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,                   
            ]);
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_path = time() . $image->getClientOriginalName();
                Storage::disk('images')->put($image_path, File::get($image));
                $ingredient->image = $image_path;
            }

            if ($request->hasFile('video_path')) {
                $video_file = $request->file('video_path');
                $video_path = time() . $video_file->getClientOriginalName();
                Storage::disk('videos')->put($video_path, File::get($video_file));
                $ingredient->video_path = $video_path;
            }

            $ingredient->save();

            Inventory::create([
                'ingredient_id' => $ingredient->ingredient_id,
                'stock' => $request->stock
            ]);
        });

        // CAMBIO CLAVE: Redirect en lugar de View
        return redirect()->route('ingredients.index')->with('message', 'Ingrediente creado con éxito');

    } catch(\Exception $e) {
        return back()->withInput()->withErrors(['error' => $e->getMessage()]);
    }
}

public function destroy($id) {
    $ingredient = Ingredient::find($id);
    
    if($ingredient) {
        if($ingredient->inventory) {
            $ingredient->inventory->delete();
        }
        $ingredient->delete();
    }

    // CAMBIO CLAVE: Redirect en lugar de View
    return redirect()->route('ingredients.index')->with('message', 'Ingrediente eliminado correctamente');
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

       public function getImage($filename)
   {
       $file = Storage::disk('images')->get($filename);
       return new Response($file, 200);
   }

   public function getVideo($filename)
   {
       $file = Storage::disk('videos')->get($filename);
       return new Response($file, 200);
   }

    public function create()
    {
        $suppliers = Supply::get();
        return view('ingredient.create', compact('suppliers'));
    }
}