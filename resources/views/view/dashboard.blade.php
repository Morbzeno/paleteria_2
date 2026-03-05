@extends('layouts.app')

@section('content')
<div id="ingredientCarousel" class="carousel slide shadow-lg rounded" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($ingredients as $index => $ingredient)
            <button type="button" data-bs-target="#ingredientCarousel" data-bs-slide-to="{{ $index }}" 
                class="{{ $index == 0 ? 'active' : '' }}" aria-current="true"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach($ingredients as $index => $ingredient)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                @if($ingredient->image)
                    <img src="http://127.0.0.1:8000/api/getImage/{{ $ingredient->image }}" 
                         class="d-block w-100" 
                         style="height: 500px; object-fit: cover;" 
                         alt="{{ $ingredient->name }}">
                @endif
                
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); border-radius: 15px;">
                    <h5>{{ $ingredient->name }}</h5>
                    <p>{{ $ingredient->description }}</p>
                    <span class="badge bg-success">Precio: ${{ number_format($ingredient->price, 2) }}</span>
                    @if ($ingredient->inventory->stock >= 21)
                        <span class="badge bg-success">Stock disponible: ${{ number_format($ingredient->inventory->stock) }}</span>
                    @elseif ($ingredient->inventory->stock >= 6 AND $ingredient->inventory->stock <= 20)
                        <span class="badge bg-warning">Stock disponible: ${{ number_format($ingredient->inventory->stock) }}</span>
                    @elseif ($ingredient->inventory->stock >= 1 AND $ingredient->inventory->stock <= 5)
                        <span class="badge bg-danger">Stock disponible: ${{ number_format($ingredient->inventory->stock) }}</span>
                    @else 
                        <span class="badge bg-danger">No hay stock disponible</span>
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

@endsection