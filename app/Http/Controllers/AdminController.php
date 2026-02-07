<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Direction;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request){
        // $admins = admin::findOrFail()->get();
        $admins = Admin::with(['user','person', 'direction'])->get();

        if($admins->isEmpty()){
            return response()->json([
                'message' => 'no se encontraron admin',
                ],400);
        }

        return response()->json([
            'message' => 'Todos los admins aquí',
            'data' => $admins
        ],200);
    }

    public function show($id){
        $admin = Admin::with(['user','person', 'direction'])->findOrFail($id)->get();

        if($admin->isEmpty()){
            return response()->json([
                'message' => 'no se encontro al admin',
                ],400);
        }

        return response()->json([
            'message' => 'datos del admin',
            'data' => $admin
        ],200);
    }

    public function store(Request $request){


        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'rol' => 'required',
            'name' => 'required|string', 
            'last_name' => 'required|string',
            'rfc' => 'required|string',
            'phone_number' => 'required|string',
            'street' => 'required|string', 
            'colony' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'payment' => 'required',
            'schedule' => 'required|string',
            'admin_type' => 'required',
        ]);
        try {
            return DB::transaction(function () use ($request){
        
                // $user = new User();
                $user = User::create([
                    'email' => $request->email, 
                    'password' => bcrypt($request->password),
                    'rol'=> $request->rol
                ]);
                $user->save();

                // $person = new Person();
                $person = Person::create([
                    'name' => $request->name, 
                    'last_name' => $request->last_name,
                    'rfc' => $request->rfc,
                    'phone_number' => $request->phone_number
                ]);
                $person->save();

                // $direction = new Direction();
                $direction = Direction::create([
                    'street' => $request->street, 
                    'colony' => $request->colony,
                    'city' => $request->city,
                    'postal_code' => $request->postal_code
                ]);
                $direction->save();

                
                // $admin = new Admin();
                $admin = Admin::create([
                    'user_id' => $user->user_id,
                    'person_id' => $person->person_id,
                    'direction_id' => $direction->direction_id,
                    'payment' => $request->payment,
                    'schedule' => $request->schedule,
                    'admin_type'=> $request->admin_type
                ]);
                $admin->save();

                return response()->json([
                    'message' => 'User actualizado correctamente',
                    'data' => $admin
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar el registro',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function update(Request $request, $id)
    {
        //busca al usuario, si no encuentra manda error
        $admin = Admin::with(['user', 'person', 'direction'])->find($id);

        if (!$admin) {
            return response()->json(['error' => 'admin no encontrado'], 404);
        }
        // los datos que se pueden alterar, esta en "sometimes" para que puedas modificar los campos que quieras, 
        // y los demas queden como estaban
        $request->validate([
            'email' => 'sometimes|string|email',
            'password' => 'sometimes|string',
            'rol' => 'sometimes',
            'name' => 'sometimes|string', 
            'last_name' => 'sometimes|string',
            'rfc' => 'sometimes|string',
            'phone_number' => 'sometimes|string',
            'street' => 'sometimes|string', 
            'colony' => 'sometimes|string',
            'city' => 'sometimes|string',
            'postal_code' => 'sometimes|string',
            'payment' => 'sometimes',
            'schedule' => 'sometimes|string',
            'admin_type' => 'sometimes',
        ]);
        try {
            return DB::transaction(function () use ($request, $admin){
        
                if ($request->hasAny(['email', 'password', 'rol'])) {
                    $userData = $request->only(['email', 'rol']);
                    if ($request->has('password')) {
                        $userData['password'] = bcrypt($request->password);
                    }
                    $admin->user->update($userData);
                }
    
                if ($request->hasAny(['name', 'last_name', 'rfc', 'phone_number'])) {
                    $admin->person->update($request->only(['name', 'last_name', 'rfc', 'phone_number']));
                }
    
                if ($request->hasAny(['street', 'colony', 'city', 'postal_code'])) {
                    $admin->direction->update($request->only(['street', 'colony', 'city', 'postal_code']));
                }
    
                $admin->update($request->only(['payment', 'schedule', 'admin_type']));

                return response()->json([
                    'message' => 'User actualizado correctamente',
                    'data' => $admin
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al procesar el registro',
                'error' => $e->getMessage()
            ],500);
        }
    }
}