<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Direction;
use App\Models\Person;
use Illuminate\Support\Facades\DB;


class ClientController extends Controller
{
    public function index(Request $request){
        // $Clients = Client::findOrFail()->get();
        $Clients = Client::with(['user','person', 'direction'])->get();

        if($Clients->isEmpty()){
            return response()->json([
                'message' => 'no se encontraron Client',
                ],400);
        }

        return response()->json([
            'message' => 'Todos los Clients aquí',
            'data' => $Clients
        ],200);
    }

    public function show($id){
        $Client = Client::with(['user','person', 'direction'])->findOrFail($id)->get();

        if($Client->isEmpty()){
            return response()->json([
                'message' => 'no se encontro al Client',
                ],400);
        }

        return response()->json([
            'message' => 'datos del Client',
            'data' => $Client
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
            'client_type' => 'required',
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

                
                // $Client = new Client();
                $Client = Client::create([
                    'user_id' => $user->user_id,
                    'person_id' => $person->person_id,
                    'direction_id' => $direction->direction_id,
                    'client_type' => $request->client_type,
                ]);
                $Client->save();

                return response()->json([
                    'message' => 'User actualizado correctamente',
                    'data' => $Client
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
        $Client = Client::with(['user', 'person', 'direction'])->find($id);

        if (!$Client) {
            return response()->json(['error' => 'Client no encontrado'], 404);
        }
        // los datos que se pueden alterar, esta en "sometimes" para que puedas modificar los campos que quieras, 
        // y los demas queden como estaban
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
            'client_type' => 'required',
        ]);
        try {
            return DB::transaction(function () use ($request, $Client){
        
                if ($request->hasAny(['email', 'password', 'rol'])) {
                    $userData = $request->only(['email', 'rol']);
                    if ($request->has('password')) {
                        $userData['password'] = bcrypt($request->password);
                    }
                    $Client->user->update($userData);
                }
    
                if ($request->hasAny(['name', 'last_name', 'rfc', 'phone_number'])) {
                    $Client->person->update($request->only(['name', 'last_name', 'rfc', 'phone_number']));
                }
    
                if ($request->hasAny(['street', 'colony', 'city', 'postal_code'])) {
                    $Client->direction->update($request->only(['street', 'colony', 'city', 'postal_code']));
                }
    
                $Client->update($request->only(['Client_type']));

                return response()->json([
                    'message' => 'User actualizado correctamente',
                    'data' => $Client
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
