<?php

use App\Http\Controllers\ProfileController;
use App\Models\Transacao;
use App\Services\TransacaoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    (new TransacaoService(userId: Auth::user()->id))->inserir(valor: 1000, tipo: 'receita', categoria: 'Prestação de Serviços', descricao: 'Alguma coisa importante', data: now());
    return Transacao::with('user')->get();
    //return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
