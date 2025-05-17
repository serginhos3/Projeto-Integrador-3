<?php

use App\Http\Controllers\PedidosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoivosController;
use App\Http\Controllers\PadrinhosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Models\Pedido;
use App\Models\Noivo;
use App\Models\Padrinho;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/noivos', [NoivosController::class, 'list'])->name('noivos.list');
    Route::get('/noivo/{id}/detalhes', [NoivosController::class, 'show'])->name('noivos.show');
    Route::get('/noivos/adicionar', [NoivosController::class, 'cadastrar'])->name('noivos.cadastrar');
    Route::get('/noivos/{id}/editar', [NoivosController::class, 'editar'])->name('noivos.editar');
    Route::post('/noivos', [NoivosController::class, 'store'])->name('noivos.store');
    Route::put('/noivo/{id}', [NoivosController::class, 'atualizar'])->name('noivo.atualizar');
    Route::delete('/noivos/{id}', [NoivosController::class, 'destroy'])->name('noivos.destroy');
    Route::post('/noivos/{noivo}/status/{status}', [NoivosController::class, 'alterarStatus'])->name('noivos.status');
    Route::get('/pedidos/obter-informacoes-noivo/{id}', [PedidosController::class, 'obterInformacoesNoivo']);
});

Route::middleware('auth')->group(function () {
    Route::get('/padrinhos', [PadrinhosController::class, 'list'])->name('padrinhos.list');    
    Route::get('/padrinhos/adicionar', [PadrinhosController::class, 'cadastrar'])->name('padrinhos.cadastrar');
    Route::get('/padrinhos/{id}/editar', [PadrinhosController::class, 'editar'])->name('padrinhos.editar');
    Route::post('/padrinhos', [PadrinhosController::class, 'store'])->name('padrinhos.store');
    Route::put('/padrinhos/{id}', [PadrinhosController::class, 'atualizar'])->name('padrinhos.atualizar');
    Route::delete('/padrinhos/{id}', [PadrinhosController::class, 'destroy'])->name('padinhos.destroy');
    Route::get('/padrinho/{id}/detalhes', [PadrinhosController::class, 'show'])->name('padrinhos.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/pedidos', [PedidosController::class, 'list'])->name('pedidos.list');
    Route::get('/pedidos/adicionar', [PedidosController::class, 'criar'])->name('pedidos.criar');
    Route::get('/pedidos/{id}/editar', [PedidosController::class, 'editar'])->name('pedidos.editar');
    Route::post('/pedidos', [PedidosController::class, 'store'])->name('pedidos.store');
    Route::put('/pedidos/{id}', [PedidosController::class, 'atualizar'])->name('pedidos.atualizar');
    Route::delete('/pedidos/{id}', [PedidosController::class, 'destroy'])->name('pedidos.destroy');
    Route::post('/pedidos/{id}/update-status', [PedidosController::class, 'updateStatus'])->name('pedidos.updateStatus');
    Route::get('/pedidos/{id}/pdf', [PedidosController::class, 'gerarPdf'])->name('pedidos.pdf');
    Route::get('/noivos/buscar', [PedidosController::class, 'buscarNoivos'])->name('noivos.buscar');
    Route::get('/pedidos/{id}', [PedidosController::class, 'show'])->name('pedidos.show');
    Route::post('/pedidos/{pedido}/status/{status}', [PedidosController::class, 'alterarStatus'])->name('pedidos.status');

});

require __DIR__ . '/auth.php';

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



