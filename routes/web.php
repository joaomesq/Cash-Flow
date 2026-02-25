<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home'); 
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
     Route::get('/home', function(){
        return view('home');
     })->name('home');

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
