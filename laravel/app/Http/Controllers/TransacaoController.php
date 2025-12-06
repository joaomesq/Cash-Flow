<?php

namespace App\Http\Controllers;

use App\Services\TransacaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransacaoController extends Controller
{
    private $transacaoService;

    public function __construct()
    {
        $this->transacaoService = new TransacaoService(Auth::user()->id);
    }

    //my
    public function show(){
        return $this->transacaoService->getAll();
    }

    public function create(){
        return view('transacao/register');
    }
}
