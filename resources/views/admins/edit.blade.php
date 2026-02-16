@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>Actualización de Administrador</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admins.update', $admin->admin_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Datos de Acceso --}}
                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Datos de Acceso</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                        value="{{ old('email', $admin->user->email) }}" 
                                        autocomplete="email" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                        placeholder="Se puede omitir este paso" 
                                        autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Información Personal --}}
                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Información Personal</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nombre(s)</label>
                                    <input type="text" id="name" name="name" class="form-control" 
                                        value="{{ old('name', $admin->person->name) }}" 
                                        autocomplete="given-name" required>
                                </div>
                                <div class="col-md-6"> 
                                    <label for="last_name" class="form-label">Apellidos</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" 
                                        value="{{ old('last_name', $admin->person->last_name) }}" 
                                        autocomplete="family-name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="rfc" class="form-label">RFC</label>
                                    <input type="text" id="rfc" name="rfc" class="form-control @error('rfc') is-invalid @enderror" 
                                        value="{{ old('rfc', $admin->person->rfc) }}" required>
                                    @error('rfc')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Número de Celular</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" 
                                        value="{{ old('phone_number', $admin->person->phone_number) }}" 
                                        autocomplete="tel" required>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Dirección</h5>
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <label for="street" class="form-label">Calle y Número</label>
                                    <input type="text" id="street" name="street" class="form-control" 
                                        value="{{ old('street', $admin->direction->street) }}" 
                                        autocomplete="address-line1" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="postal_code" class="form-label">Código Postal</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" 
                                        value="{{ old('postal_code', $admin->direction->postal_code) }}" 
                                        autocomplete="postal-code" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="colony" class="form-label">Colonia</label>
                                    <input type="text" id="colony" name="colony" class="form-control" 
                                        value="{{ old('colony', $admin->direction->colony) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">Ciudad</label>
                                    <input type="text" id="city" name="city" class="form-control" 
                                        value="{{ old('city', $admin->direction->city) }}" 
                                        autocomplete="address-level2" required>
                                </div>
                            </div>
                        </div>

                        {{-- Detalles Administrativos --}}
                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Detalles Administrativos</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="payment" class="form-label">Pago Mensual</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="payment" name="payment" class="form-control" 
                                            step="0.01" value="{{ old('payment', $admin->payment) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="schedule" class="form-label">Horario</label>
                                    <input type="text" id="schedule" name="schedule" class="form-control" 
                                        value="{{ old('schedule', $admin->schedule) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="admin_type" class="form-label">Tipo de Admin</label>
                                    <select id="admin_type" name="admin_type" class="form-select">
                                        <option value="normal" {{ old('admin_type', $admin->admin_type) == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="super" {{ old('admin_type', $admin->admin_type) == 'super' ? 'selected' : '' }}>Super</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-light me-md-2">Limpiar</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Actualizar Administrador</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection