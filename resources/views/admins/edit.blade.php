@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>Registro de Administrador</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admins.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Datos de Acceso</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control" value="{{old('name',$admin->user->email)}}" required >
                                    @error('email')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" value="{{old('password', $admin->user->password)}}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Información Personal</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre(s)</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name', $admin->person->name)}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" name="last_name" class="form-control" value="{{old('last_name', $admin->person->last_name)}}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RFC</label>
                                    <input type="text" name="rfc" class="form-control" value="{{old('rfc', $admin->person->rfc)}}" required>
                                    @error('rfc')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Número de Celular</label>
                                    <input type="text" name="phone_number" class="form-control" required>
                                    @error('phone_number')
                                        <span style="color: red;"> {{$message}}</span>
                                    @enderror
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
                            <h5 class="text-secondary border-bottom pb-2">Detalles Administrativos</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Pago Mensual</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="payment" class="form-control" step="0.01" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Horario</label>
                                    <input type="text" name="schedule" class="form-control" placeholder="08:00 - 16:00" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tipo de Admin</label>
                                    <select name="admin_type" class="form-select">
                                        <option value="normal" selected>Normal</option>
                                        <option value="super">Super</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-light me-md-2">Limpiar</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Guardar Administrador</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection