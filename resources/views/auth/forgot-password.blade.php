@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Recuperar contraseña</h4>
                </div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success shadow-sm" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-muted small">
                        Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-form-label">Correo Electrónico</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="ejemplo@correo.com"
                                   required 
                                   autofocus>
                            
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-envelope"></i> Enviar enlace de recuperación
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-link btn-sm text-decoration-none">
                                Volver al inicio de sesión
                            </a>
                        </div>
                    </form>
                </div>

@sectionend