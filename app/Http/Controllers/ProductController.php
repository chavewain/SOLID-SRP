<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Lista los productos con paginación ligera.
     */
    public function index(): View
    {
        return view('products.index', [
            'products' => Product::latest()->paginate(8),
        ]);
    }

    /**
     * Muestra el formulario con los valores por defecto.
     */
    public function create(): View
    {
        return view('products.create', [
            'product' => new Product(),
        ]);
    }

    /**
     * Procesa la creación a través del servicio dedicado.
     */
    public function store(ProductRequest $request, ProductService $service): RedirectResponse
    {
        $service->save($request);

        return redirect()
            ->route('products.index')
            ->with('status', 'Producto creado correctamente.');
    }

    /**
     * Muestra un producto individual para referencia.
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Presenta el formulario para actualizar un producto.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Actualiza los datos delegando al servicio para mantener SRP.
     */
    public function update(ProductRequest $request, Product $product, ProductService $service): RedirectResponse
    {
        $service->save($request, $product);

        return redirect()
            ->route('products.show', $product)
            ->with('status', 'Producto actualizado con éxito.');
    }

    /**
     * Elimina el recurso usando el servicio especializado.
     */
    public function destroy(Product $product, ProductService $service): RedirectResponse
    {
        $service->delete($product);

        return redirect()
            ->route('products.index')
            ->with('status', 'Producto eliminado.');
    }
}

