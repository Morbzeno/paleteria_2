@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>Registro de Proveedor</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('supply.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Datos de Acceso</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="name" class="form-control" placeholder="Nombre del proovedor" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Descripcion</label>
                                    <input type="text" name="description" class="form-control"  required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Numero telefonico</label>
                                    <input type="text" name="phone_number" class="form-control"  required>
                                    @error('phone_number')
                                        <span style="color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                 <div class="col-md-6">
                                    <label class="form-label">Ultima entrega</label>
                                    <input type="date" name="last_supply" class="form-control"  required>
                                </div>
                                <input type="hidden" name="rol" value="client">
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