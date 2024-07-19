<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:30',
            'descricao' => 'required|string|max:200',
            'quantidadePsicologos' => 'required|integer',
            'valor' => 'required|numeric',
        ]);

        Plano::create($validatedData);

        return redirect()->route('planos.index');
    }

    public function index()
    {
        $planos = Plano::all();
        return view('Planos', compact('planos'));
    }
    public function mindSyncPayment(Request $request)
    {
        $nome = $request->query('nome');
        $valor = $request->query('valor');
        $quantidadePsicologos = $request->query('quantidadePsicologos');

        return view('MindSyncPayment', compact('nome', 'quantidadePsicologos', 'valor'));
    }

}
