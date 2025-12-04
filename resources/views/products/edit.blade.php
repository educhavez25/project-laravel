@extends('layouts.app')
@section('title', 'Laravel 12 CRUD')

@section('content')
    @if ($errors->any())

        <div class="alert alert-danger alert-dismissible alert-additional fade show" role="alert">
            <div class="alert-body">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-error-warning-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Opps!</h5>
                        <p class="mb-0">Hay problemas con los inputs. </p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">Validar correctamente los datos.</p>
            </div>
        </div>
{{-- 
        <div>
            <strong>Opps!</strong> Hay problemas con los inputs. <br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div> --}}

    @endif

    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Editar Producto</h4>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <div class="row gy-4">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="basiInput" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="basiInput" name="name"
                                    value="{{ $product->name }}" placeholder="Ingrese el nombre">
                            </div>
                        </div>
                        <br>
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="basiInput" class="form-label">Precio:</label>
                                <input type="text" class="form-control" id="basiInput" name="price"
                                    value="{{ $product->price }}" placeholder="Ingrese el precio">
                            </div>
                        </div>
                        <br>
                        <div class="col-xxl-6 col-md-6">
                            <div>
                                <label for="basiInput" class="form-label">Descripción:</label>
                                <textarea class="form-control" id="basiInput" name="description" placeholder="Ingrese la descripción">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12">
                            <button type="submit" type="button"
                                class="btn btn-warning btn-label waves-effect waves-light">
                                <i class="ri-check-double-fill label-icon align-middle fs-16 me-2"></i>
                                Actualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="">Nombre:</label>
                <input type="text" name="name" value="{{ $product->name }}" placeholder="Ingrese el nombre">
                <br><br>
                <label for="">Precio:</label>
                <input type="text" name="price" value="{{ $product->price }}" placeholder="Ingrese el precio">
                <br><br>
                <label for="">Descripción:</label>
                <textarea name="description" placeholder="Ingrese la descripción">{{ $product->description }}</textarea>
                <br><br>
                <button type="submit">Actualizar</button>
            </form> --}}

@endsection
