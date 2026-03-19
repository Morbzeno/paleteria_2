@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
            <div class="card shadow-sm border-0">
                
                <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-images me-2"></i>Lista de Assets
                    </h4>
                    <a href="{{ route('assets.create') }}" class="btn btn-light btn-sm shadow-sm">
                        <i class="fas fa-plus me-1"></i> Nuevo Asset
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
                                    <th style="width: 240px;">Imagen</th>
                                    <th style="width: 240px;">video</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assets as $asset)
                                    <tr>
                                        <td>
                                            @if($asset->image)
                                                <img src="http://127.0.0.1:8000/api/getImage/{{ $asset->image }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 240px; height: 240px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center border rounded" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($asset->video)
                                                <video controls style="width: 240px; height: 240px; object-fit: cover;">
                                                    <source src="{{ asset('storage/videos/' . $asset->video) }}" type="video/mp4">
                                                    Tu navegador no soporta el formato de video.
                                                </video>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <i class="fas fa-box-open fa-3x mb-3 d-block"></i>
                                            No hay assets registrados aún.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $assets->links() }}
                    </div>   

                </div>
            </div>
        </div>
    </div>
</div>

@endsection