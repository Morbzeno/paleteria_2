@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('clients.store') }}">
                        @csrf

<div class="row mb-3">
    <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="last_name" class="col-md-4 col-form-label text-md-end">Apellido</label>
    <div class="col-md-6">
        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>
        @error('last_name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="rfc" class="col-md-4 col-form-label text-md-end">RFC</label>
    <div class="col-md-6">
        <input id="rfc" type="text" class="form-control @error('rfc') is-invalid @enderror" name="rfc" value="{{ old('rfc') }}" required>
        @error('rfc')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="phone_number" class="col-md-4 col-form-label text-md-end">Teléfono</label>
    <div class="col-md-6">
        <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>
        @error('phone_number')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="street" class="col-md-4 col-form-label text-md-end">Calle</label>
    <div class="col-md-6">
        <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" required>
        @error('street')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="colony" class="col-md-4 col-form-label text-md-end">Colonia</label>
    <div class="col-md-6">
        <input id="colony" type="text" class="form-control @error('colony') is-invalid @enderror" name="colony" value="{{ old('colony') }}" required>
        @error('colony')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="city" class="col-md-4 col-form-label text-md-end">Ciudad</label>
    <div class="col-md-6">
        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required>
        @error('city')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="postal_code" class="col-md-4 col-form-label text-md-end">Código Postal</label>
    <div class="col-md-6">
        <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required>
        @error('postal_code')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="client_type" class="col-md-4 col-form-label text-md-end">Tipo de Cliente</label>
    <div class="col-md-6">
        <select id="client_type" class="form-select @error('client_type') is-invalid @enderror" name="client_type" required>
            <option value="" selected disabled>Seleccione una opción...</option>
            <option value="frecuente" {{ old('client_type') == 'frecuente' ? 'selected' : '' }}>Frecuente</option>
            <option value="empresarial" {{ old('client_type') == 'empresarial' ? 'selected' : '' }}>Empresarial</option>
        </select>
        @error('client_type')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>

<input type="hidden" name="rol" value="cliente">



        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
