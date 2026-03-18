@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-images me-2"></i>Registro de Assets</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-4">
                            <h5 class="text-secondary border-bottom pb-2">Multimedia</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="image_input" class="form-label">Imagen (jpg, jpeg, png, gif)</label>
                                        <input type="file" 
                                            id="image_input" 
                                            name="image" 
                                            class="form-control" 
                                            accept="image/*" 
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="video_input" class="form-label">Video (mp4)</label>
                                        <input type="file" 
                                            id="video_input" 
                                            name="video" 
                                            class="form-control" 
                                            accept="video/mp4" 
                                            required>
                                    </div>
                                </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-light me-md-2">Limpiar</button>
                            <button type="submit" class="btn btn-primary px-5 shadow-sm">Guardar Assets</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection