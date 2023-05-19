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
Route::get('/cadProdutoss', [App\Http\Controllers\ProdutoController::class, 'indexs'])->name('cadProdutoss');
Route::post('/newProductSubmit', [App\Http\Controllers\ProdutoController::class, 'store'])->name('newProductSubmit');
Route::post('/editProductSubmit/{id}', [App\Http\Controllers\ProdutoController::class, 'update'])->name('editProductSubmit');

Route::get('/estoque', [App\Http\Controllers\EstoqueController::class, 'index'])->name('estoque');
Route::get('/vendas', [App\Http\Controllers\VendaController::class, 'index'])->name('venda');
Route::get('/financeiro', [App\Http\Controllers\FinanceiroController::class, 'index'])->name('financeiro');


Route::get('/cadClientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('cadClientes');
Route::post('/newclientSubmit', [App\Http\Controllers\ClienteController::class, 'store'])->name('newclientSubmit');
Route::post('/editclientSubmit/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('editclientSubmit');

Route::get('/cadFornecedores', [App\Http\Controllers\FornecedorController::class, 'index'])->name('cadFornecedores');
Route::post('/newFornecSubmit', [App\Http\Controllers\FornecedorController::class, 'store'])->name('newFornecSubmit');
Route::post('/editFornecSubmit/{id}', [App\Http\Controllers\FornecedorController::class, 'update'])->name('editFornecSubmit');

Route::post('/newEstoqueSubmit', [App\Http\Controllers\EstoqueController::class, 'store'])->name('newEstoqueSubmit');