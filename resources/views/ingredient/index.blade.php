@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card shadow-sm border-0">
                
                <!-- Header -->
                <div class="card-header bg-info text-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>Lista de proveedores
                    </h4>
                    <a href="{{ route('ingredient.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo proveedor
                    </a>
                </div>

                <!-- Body -->
                <div class="card-body p-4">

                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Ultima entrega</th>
                                    <th>Contacto telefonico</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ingredients as $ingredient)
                                    <tr>
                                        <td>
                                           <img src="http://127.0.0.1:8000/api/getImage/{{ optional($ingredient)->image ?? 'Sin nombre' }}" alt=""> 
                                           "{{ optional($ingredient)->image ?? 'Sin nombre' }}"
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('ingredient.edit', $ingredient->ingredient_id) }}" 
                                               class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('ingredient.destroy', $ingredient->ingredient_id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            No hay ingredientes registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $ingredients->links() }}
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
