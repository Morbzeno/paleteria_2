@extends('layouts.app')
@section('content')
<h1>Lista de Administradores</h1>

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <a href="{{ route('admins.create') }}">crear admins</a>
        @foreach ($admins as $admin)
        <tr>
            <td>{{ $admin->person->nombre ?? 'Sin nombre' }}</td>
            <td>{{ $admin->user->email ?? 'Sin email' }}</td> 
            <td>
                <a href="{{ route('admins.edit', $admin->admin_id) }}">Editar</a>
                
                  <form action="{{ route('admins.destroy', $admin->admin_id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $admins->links() }}
@endsection