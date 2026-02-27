@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-utensils me-2"></i>Registro de Ingrediente</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('ingredients.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Información del Producto</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre del Ingrediente</label>
                                    <input type="text" name="name" class="form-control" placeholder="Ej. Harina" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Precio</label>
                                    <input type="number" name="price" step="0.01" class="form-control" placeholder="0.00" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Stock Inicial</label>
                                    <input type="number" name="stock" class="form-control" placeholder="0" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="description" class="form-control" rows="2" required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Proveedor</h5>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label">Seleccionar Proveedor</label>
                                    <select name="supplier" class="form-select" required>
                                        <option value="" selected disabled>Elija un proveedor...</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Multimedia</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Imagen (jpg, jpeg, png, gif)</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Video (mp4)</label>
                                    <input type="file" name="video_path" class="form-control" accept="video/mp4" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-light me-md-2">Limpiar</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Guardar Ingrediente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection