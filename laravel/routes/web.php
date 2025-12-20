<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransacaoController;
use App\Models\Transacao;
use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //transaction
    Route::get('/transacoes', [TransacaoController::class, 'show'])->name('transacoes');
    Route::get('/transacao/create', [TransacaoController::class, 'create'])->name('transacao.create');
    Route::get('/historico', [TransacaoController::class, 'getAll'])->name('transacao.historico');


    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
