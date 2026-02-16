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
        $clients = Client::with(['user','person', 'direction'])->paginate(10);

        // if($clients->isEmpty()){
        //     return response()->json([
        //         'message' => 'no se encontraron Client',
        //         ],400);
        // }

        return view('clients.index', compact('clients'));
        // return response()->json([
        //     'message' => 'Todos los Clients aquí',
        //     'data' => $Clients
        // ],200);
    }

    public function show($id){
        $Client = Client::with(['user', 'person', 'direction'])->findOrFail($id);

        // return response()->json([
        //     'message' => 'datos del Client',
        //     'data' => $Client
        // ],200);
        
    }

    public function create(){
        return view('clients.create');
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

                // return response()->json([
                //     'message' => 'User actualizado correctamente',
                //     'data' => $Client
                // ], 200);
                $clients = Client::with(['user','person', 'direction'])->paginate(10);

                return view('clients.index', compact('clients'));
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
    $client = client::with(['user', 'person', 'direction'])->findOrFail($id);

    $request->validate([
        'email' => 'sometimes|email',
        'password' => 'nullable|min:6', // Usamos nullable para que no obligue si viene vacío
        'name' => 'sometimes|string', 
        'last_name' => 'sometimes|string',
        'rfc' => 'sometimes|string',
        'phone_number' => 'sometimes|string',
        'street' => 'sometimes|string', 
        'colony' => 'sometimes|string',
        'city' => 'sometimes|string',
        'postal_code' => 'sometimes|string',
        'client_type' => 'sometimes|string'
    ]);

    try {
        return DB::transaction(function () use ($request, $client) {
            
            $userData = $request->only(['email']);
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }
            $client->user->update($userData);

            $client->person->update($request->only(['name', 'last_name', 'rfc', 'phone_number']));

            $client->direction->update($request->only(['street', 'colony', 'city', 'postal_code']));

            $client->update($request->only(['client_type']));

            return redirect()->route('clients.index')->with('success', 'cliente actualizado correctamente');
        });

        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Error al actualizar: ' . $e->getMessage()]);
        }
    }

        public function edit($id)
    {
        $client = Client::with(['user', 'person', 'direction'])->find($id);

   
        return view('clients.edit', compact('client'));
    }

    public function destroy($id){
        $client = Client::find($id);

        if(!$client){
            return response()->json([
                'message' => 'client no encontrado'
            ], 404);
        }
        
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'cliente eliminado correctamente.');
        // return response()->json([
        //     'message' => 'client eliminado correctamente'
        // ], 200);
    }

}
