@extends('layouts.app')

@section('title', 'Catálogo de productos')

@section('content')
    <div class="card">
        <h1>Catálogo de productos</h1>
        <p class="description">Esta vista lista productos recientes y expone acciones para editar o eliminar.</p>

        @forelse($products as $product)
            <article class="card" style="margin-top:1rem;">
                <header>
                    <h2>{{ $product->name }}</h2>
                    <small>{{ $product->created_at->format('d-m-Y') }}</small>
                </header>

                @if($product->image_path)
                    <img class="preview" src="{{ asset('storage/' . $product->image_path) }}" alt="Imagen de {{ $product->name }}">
                @endif

                <p>{{ $product->description }}</p>

                <ul>
                    <li>Precio: ${{ number_format($product->price, 2) }}</li>
                    <li>Stock: {{ $product->stock }}</li>
                    <li>Activo: {{ $product->is_active ? 'Sí' : 'No' }}</li>
                    <li>Lanzamiento: {{ optional($product->released_at)->toFormattedDateString() ?? 'Pendiente' }}</li>
                </ul>

                @php
                    $metadata = $product->metadata ?? [];
                @endphp
                @if(!empty($metadata))
                    <p><strong>Metadatos:</strong> {{ json_encode($metadata, JSON_UNESCAPED_UNICODE) }}</p>
                @endif

                <div style="display:flex;gap:0.5rem;">
                    <a href="{{ route('products.show', $product) }}">Ver</a>
                    <a href="{{ route('products.edit', $product) }}">Editar</a>
                    <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </div>
            </article>
        @empty
            <p>No hay productos registrados aún.</p>
        @endforelse

        <div style="margin-top: 1rem;">
            {{ $products->links() }}
        </div>
    </div>
@endsection

