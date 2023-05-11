<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cadProdutos', [App\Http\Controllers\ProdutoController::class, 'index'])->name('cadProdutos');
Route::get('/cadClientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('cadClientes');
Route::get('/cadFornecedores', [App\Http\Controllers\FornecedorController::class, 'index'])->name('cadFornecedores');
Route::get('/estoque', [App\Http\Controllers\EstoqueController::class, 'index'])->name('estoque');
Route::get('/vendas', [App\Http\Controllers\VendaController::class, 'index'])->name('venda');
Route::get('/financeiro', [App\Http\Controllers\FinanceiroController::class, 'index'])->name('financeiro');

Route::post('/newProductSubmit', [App\Http\Controllers\ProdutoController::class, 'store'])->name('newProductSubmit');