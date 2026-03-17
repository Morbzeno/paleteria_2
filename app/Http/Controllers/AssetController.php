<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\Models\Assets;

class AssetController extends Controller
{
    public function index(Request $request){
        // $ingredients = ingredient::findOrFail()->get();
        $assets = Assets::paginate(10);

        return view('assets.index', compact('assets'));
    }
    public function create()
    {
        $Assets = Assets::get();
        return view('assets.create', compact('Assets'));
    }

    public function store(Request $request) {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'video' => 'required|mimes:mp4'
        ]);

        try {
            DB::transaction(function () use ($request) {
                $Asset = Assets::create([
                    'image' => $request->image,            
                ]);
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_path = time() . $image->getClientOriginalName();
                    Storage::disk('images')->put($image_path, File::get($image));
                    $Asset->image = $image_path;
                }

                if ($request->hasFile('video')) {
                    $video_file = $request->file('video');
                    $filename = time() . '_' . str_replace(' ', '_', $video_file->getClientOriginalName());
                    $video_file->storeAs('videos', $filename, 'public');
                    $Asset->video = $filename;
                }

                $Asset->save();
            });

            return redirect()->route('assets.index')->with('message', 'Activo creado con éxito');

        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
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
       return response()->file($file, [
        'Content-Type' => 'video/mp4',
        'Access-Control-Allow-Origin' => '*', 
        'Access-Control-Allow-Methods' => 'GET',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
        ]);
   }

}
