@extends('layouts.app')

@section('title', 'Detalle del producto')

@section('content')
    <article class="card">
        <h1>{{ $product->name }}</h1>
        <p><strong>Slug: </strong>{{ $product->slug }}</p>
        <p>{{ $product->description }}</p>

        @if($product->image_path)
            <img class="preview" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
        @endif

        <dl>
            <dt>Precio</dt>
            <dd>${{ number_format($product->price, 2) }}</dd>

            <dt>Stock</dt>
            <dd>{{ $product->stock }}</dd>

            <dt>Activo</dt>
            <dd>{{ $product->is_active ? 'Sí' : 'No' }}</dd>

            <dt>Lanzado</dt>
            <dd>{{ optional($product->released_at)->format('d-m-Y') ?? 'Pendiente' }}</dd>
        </dl>

        @if(!empty($product->metadata))
            <section>
                <h3>Metadatos registrados</h3>
                <pre>{{ json_encode($product->metadata, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) }}</pre>
            </section>
        @endif

        <div style="margin-top:1rem;">
            <a href="{{ route('products.edit', $product) }}">Editar</a>
            <a href="{{ route('products.index') }}">Volver al listado</a>
        </div>
    </article>
@endsection

