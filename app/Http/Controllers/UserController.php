<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        // $users = User::findOrFail()->get();
        $users = User::with('client')->get();

        if($users->isEmpty()){
            return response()->json([
                'message' => 'no se encontraron usuarios',
                ],400);
        }

        return response()->json([
            'message' => 'Todos los usuarios aquí',
            'data' => $users
        ],200);
    }

    public function show($id){
        $user = User::findOrFail($id)->get();

        if($user->isEmpty()){
            return response()->json([
                'message' => 'no se encontro al usuario',
                ],400);
        }

        return response()->json([
            'message' => 'datos del usuario',
            'data' => $user
        ],200);
    }
}
