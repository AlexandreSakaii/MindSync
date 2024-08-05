<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionType;
use Illuminate\Support\Facades\Auth;

class SessionTypeController extends Controller
{
    public function index()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTypes = SessionType::where('psychologist_id', $psychologist->id)->get();
        return view('ConfigPsicologo', compact('sessionTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:7', // Valida a cor
        ]);

        $psychologist = Auth::guard('psychologist')->user();

        SessionType::create([
            'psychologist_id' => $psychologist->id,
            'name' => $request->input('name'),
            'color' => $request->input('color'), // Salva a cor
        ]);

        return redirect()->back()->with('success', 'Tipo de sessão criado com sucesso.');
    }

    public function destroy($id)
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionType = SessionType::where('psychologist_id', $psychologist->id)->findOrFail($id);
        $sessionType->delete();

        return redirect()->back()->with('success', 'Tipo de sessão excluído com sucesso.');
    }

    public function getSessionTypes()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTypes = SessionType::where('psychologist_id', $psychologist->id)->get();
        return response()->json($sessionTypes);
    }

    public function showDeshboard()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTypes = SessionType::where('psychologist_id', $psychologist->id)->get();
        return view('Deshboard', compact('sessionTypes'));
    }
}
