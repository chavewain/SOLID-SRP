@extends('layouts.app')

@section('title', 'Editar producto')

@section('content')
    <h1>Editar {{ $product->name }}</h1>
    <p class="description">Revisa los datos actuales y ajusta los campos necesarios.</p>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('products._form', ['buttonText' => 'Actualizar producto'])
    </form>
@endsection

