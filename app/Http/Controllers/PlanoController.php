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
            'quantidade_psicologos' => 'required|integer',
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
}
