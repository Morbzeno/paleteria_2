@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card shadow-sm border-0">
                
                <!-- Header -->
                <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>Lista de Clientes
                    </h4>
                    <a href="{{ route('clients.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo Cliente
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clients as $client)
                                    <tr>
                                        <td>
                                            {{ optional($client->person)->name ?? 'Sin nombre' }}
                                        </td>
                                        <td>
                                            {{ optional($client->user)->email ?? 'Sin email' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('clients.edit', $client->client_id) }}" 
                                               class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('clients.destroy', $client->client_id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            No hay clientes registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $clients->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
