@extends('layouts.app')
@section('title', 'Laravel 12 CRUD')

@section('content')
    @php
        $alerts = [
            'success' => ['icon' => 'ri-check-double-line', 'class' => 'alert-success'],
            'updated' => ['icon' => 'ri-refresh-line', 'class' => 'alert-info'],
            'deleted' => ['icon' => 'ri-delete-bin-2-line', 'class' => 'alert-danger']
        ];
    @endphp

    @foreach($alerts as $type => $alert)
        @if ($message = Session::get($type))
            <div class="alert {{ $alert['class'] }} alert-border-left alert-dismissible fade show" role="alert">
                <i class="{{ $alert['icon'] }} me-3 align-middle"></i> <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    @endforeach

    <a href="{{ route('products.create') }}" type="button" class="btn btn-success btn-label waves-effect waves-light">
        <i class="ri-add-box-fill label-icon align-middle fs-16 me-2"></i> Add
    </a>
    <br><br>

    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Lista de Productos</h4>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <center>ID</center>
                                </th>
                                <th>
                                    <center>Nombre</center>
                                </th>
                                <th>
                                    <center>Precio</center>
                                </th>
                                <th>
                                    <center>Descripción</center>
                                </th>
                                <th>
                                    <center>Acciones</center>
                                </th>
                        </thead>

                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <center>{{ $product->id }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $product->name }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $product->price }}</center>
                                    </td>
                                    <td>
                                        <center>{{ $product->description }}</center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="{{ route('products.show', $product->id) }}" type="button"
                                                class="btn btn-info btn-label waves-effect waves-light">
                                                <i class="ri-eye-fill label-icon align-middle fs-16 me-2"></i> Details
                                            </a>

                                            <a href="{{ route('products.edit', $product->id) }}" type="button"
                                                class="btn btn-warning btn-label waves-effect waves-light">
                                                <i class="ri-pencil-fill label-icon align-middle fs-16 me-2"></i> Edit
                                            </a>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" type="button"
                                                    class="btn btn-danger btn-label waves-effect waves-light">
                                                    <i class="ri-delete-bin-2-fill label-icon align-middle fs-16 me-2"></i>
                                                    Delete
                                                </button>
                                            </form>

                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection
