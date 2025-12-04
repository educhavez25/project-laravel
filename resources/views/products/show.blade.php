@extends('layouts.app')
@section('title', 'Laravel 12 CRUD')

@section('content')

    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Detalle Producto</h4>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <div class="row gy-4">
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">ID:</label>
                            <input type="text" class="form-control" id="basiInput" name="name"
                                value="{{ $product->id }}" readonly>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="basiInput" name="name"
                                value="{{ $product->name }}" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Precio:</label>
                            <input type="text" class="form-control" id="basiInput" name="price"
                                value="{{ $product->price }}" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="basiInput" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="basiInput" name="description" readonly>{{ $product->description }}</textarea>
                        </div>
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <a href="{{ route('products.index') }}" type="button"
                            class="btn btn-primary btn-label waves-effect waves-light">
                            <i class="ri-arrow-go-back-fill label-icon align-middle fs-16 me-2"></i>
                            Volver al listado
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <h1>Producto Detalle</h1>
    <a href="{{ route('products.index') }}">Volver al listado</a>
    <br>
    <label for="">Id:</label>
    <P>{{ $product->id }}</P>
    <label for="">Nombre:</label>
    <P>{{ $product->name }}</P>
    <label for="">Precio:</label>
    <P>{{ $product->price }}</P>
    <label for="">Descripcion:</label>
    <P>{{ $product->description }}</P> --}}
@endsection
