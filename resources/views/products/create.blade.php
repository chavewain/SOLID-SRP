@extends('layouts.app')

@section('title', 'Crear producto')

@section('content')
    <h1>Nuevo producto</h1>
    <p class="description">Completa el formulario con la información más reciente del producto.</p>

    @php
        $product = new \App\Models\Product();
    @endphp

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('products._form', ['buttonText' => 'Guardar producto'])
    </form>
@endsection

