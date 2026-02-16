@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>Registro de Cliente</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Datos de Acceso</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control" placeholder="ejemplo@correo.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" placeholder="********" required>
                                </div>
                                <input type="hidden" name="rol" value="client">
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Información Personal</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre(s)</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RFC</label>
                                    <input type="text" name="rfc" class="form-control" placeholder="ABCD123456XYZ" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Número de Celular</label>
                                    <input type="text" name="phone_number" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Dirección</h5>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label class="form-label">Calle y Número</label>
                                    <input type="text" name="street" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Código Postal</label>
                                    <input type="text" name="postal_code" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Colonia</label>
                                    <input type="text" name="colony" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ciudad</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Detalles Cliente</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Tipo de cliente</label>
                                    <select name="client_type" class="form-select">
                                        <option value="normal" selected>Normal</option>
                                        <option value="wholesarer">wholesare</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-light me-md-2">Limpiar</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Guardar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection