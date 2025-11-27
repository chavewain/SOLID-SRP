<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    /**
     * Persiste los datos del formulario y gestiona la carga de archivos.
     */
    public function save(ProductRequest $request, ?Product $product = null): Product
    {
        $product ??= new Product();
        $data = $request->normalized();

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $data['image_path'] = $this->storeImage($request->file('image'));
        }

        $product->fill($data);
        $product->save();

        return $product;
    }

    /**
     * Maneja la lógica de almacenamiento para la imagen del producto.
     */
    protected function storeImage(UploadedFile $file): string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    /**
     * Elimina el producto y sus recursos relacionados de almacenamiento.
     */
    public function delete(Product $product): void
    {
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();
    }
}

