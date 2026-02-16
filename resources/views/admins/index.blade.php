@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card shadow-sm border-0">
                
                <!-- Header -->
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-users me-2"></i>Lista de admins
                    </h4>
                    <a href="{{ route('admins.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo admine
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
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td>
                                            {{ optional($admin->person)->name ?? 'Sin nombre' }}
                                        </td>
                                        <td>
                                            {{ optional($admin->user)->email ?? 'Sin email' }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admins.edit', $admin->admin_id) }}" 
                                               class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admins.destroy', $admin->admin_id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este admine?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">
                                            No hay admins registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $admins->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
