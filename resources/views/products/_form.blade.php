{{-- Campos reutilizables para crear o actualizar productos --}}
@php
    $metadataValue = old('metadata');
    if (is_array($metadataValue)) {
        $metadataValue = json_encode($metadataValue, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } elseif (is_null($metadataValue)) {
        $metadataValue = json_encode($product->metadata ?? [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
@endphp

<div class="card">
    <div class="field">
        <label for="name">Nombre</label>
        <input id="name" name="name" type="text" value="{{ old('name', $product->name) }}" required>
        @error('name')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label for="slug">Slug</label>
        <input id="slug" name="slug" type="text" value="{{ old('slug', $product->slug) }}">
        <small>Si no se proporciona, se genera automáticamente.</small>
        @error('slug')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label for="description">Descripción</label>
        <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
        @error('description')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label for="price">Precio (USD)</label>
        <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
        @error('price')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label for="stock">Stock</label>
        <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required>
        @error('stock')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label for="released_at">Fecha de lanzamiento</label>
        <input id="released_at" name="released_at" type="date" value="{{ old('released_at', optional($product->released_at)->toDateString()) }}">
        @error('released_at')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label for="image">Imagen principal</label>
        <input id="image" name="image" type="file" accept="image/*">
        @error('image')
            <small>{{ $message }}</small>
        @enderror
        @if($product->image_path)
            <img class="preview" src="{{ asset('storage/' . $product->image_path) }}" alt="Imagen guardada">
        @endif
    </div>

    <div class="field">
        <label for="metadata">Metadatos (JSON)</label>
        <textarea id="metadata" name="metadata">{{ $metadataValue }}</textarea>
        <small>Por ejemplo: {"color": "azul", "talla": "M"}</small>
        @error('metadata')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <label>
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            Producto activo
        </label>
        @error('is_active')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="field">
        <button type="submit">{{ $buttonText }}</button>
    </div>
</div>

<style>
    button {
        background: #1f2937;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
    }
</style>

