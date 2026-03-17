@extends('layouts.app')

@section('content')
<div id="ingredientCarousel" class="carousel slide shadow-lg rounded overflow-hidden" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($ingredients as $index => $ingredient)
            <button type="button" data-bs-target="#ingredientCarousel" data-bs-slide-to="{{ $index }}" 
                class="{{ $index == 0 ? 'active' : '' }}" aria-current="true"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($ingredients as $index => $ingredient)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="5000">
                @if($ingredient->image)
                    <img src="http://127.0.0.1:8000/api/getImage/{{ $ingredient->image }}" 
                         class="d-block w-100" 
                         style="height: 500px; object-fit: cover;" 
                         alt="{{ $ingredient->name }}">
                @else
                    <div class="d-block w-100 bg-secondary d-flex align-items-center justify-content-center" style="height: 500px;">
                        <i class="fas fa-carrot fa-5x text-white"></i>
                    </div>
                @endif
                
                <div class="carousel-caption d-none d-md-block p-3" style="background: rgba(0,0,0,0.6); border-radius: 15px; bottom: 10%;">
                    <h3 class="fw-bold">{{ $ingredient->name }}</h3>
                    <p>{{ $ingredient->description }}</p>
                    
                    <div class="mb-2">
                        <span class="badge bg-light text-dark fs-6">Precio: ${{ number_format($ingredient->price, 2) }}</span>
                    </div>

                    {{-- Lógica de Stock corregida --}}
                    @if ($ingredient->inventory->stock >= 21)
                        <span class="badge bg-success">Stock: {{ $ingredient->inventory->stock }} unidades</span>
                    @elseif ($ingredient->inventory->stock >= 6)
                        <span class="badge bg-warning text-dark">Stock: {{ $ingredient->inventory->stock }} unidades</span>
                    @elseif ($ingredient->inventory->stock >= 1)
                        <span class="badge bg-danger">¡Últimas {{ $ingredient->inventory->stock }} unidades!</span>
                    @else 
                        <span class="badge bg-secondary">Sin existencias</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#ingredientCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#ingredientCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card shadow-sm border-0">
                
                <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-utensils me-2"></i>Lista de Ingredientes
                    </h4>
                    <a href="{{route('ingredients.generatePDF')}}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-file-pdf me-1"></i> Generar PDF
                    </a>
                    <a href="{{ route('ingredients.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo Ingrediente
                    </a>
                </div>

                <div class="card-body p-4">

                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 100px;">Imagen</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ingredients as $ingredient)
                                    <tr>
                                        <td>
                                            @if($ingredient->image)
                                                <img src="http://127.0.0.1:8000/api/getImage/{{ $ingredient->image }}" 
                                                     alt="{{ $ingredient->name }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center border rounded" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="fw-bold">{{ $ingredient->name }}</td>
                                        <td class="text-muted small">{{ Str::limit($ingredient->description, 50) }}</td>
                                        <td><span class="badge bg-light text-dark border">${{ number_format($ingredient->price, 2) }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('ingredients.edit', $ingredient->ingredient_id) }}" 
                                               class="btn btn-sm btn-outline-warning me-2" 
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('ingredients.destroy', $ingredient->ingredient_id) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este ingrediente?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <i class="fas fa-box-open fa-3x mb-3 d-block"></i>
                                            No hay ingredientes registrados aún.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $ingredients->links() }}
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>
@endsection