<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Esta ruta principal delega en la lista de productos para que la app
| siempre cargue la interfaz de administración.
|
*/
Route::get('/', fn () => redirect()->route('products.index'));

Route::resource('products', ProductController::class);
