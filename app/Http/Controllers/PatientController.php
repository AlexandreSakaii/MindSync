<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'required|date_format:Y-m-d',
            'number' => 'required|string|max:30',
            'cpf' => 'required|string|max:14|unique:patients',
            'description' => 'nullable|string',
        ]);

        $psychologist = Auth::guard('psychologist')->user();

        $patient = new Patient([
            'psychologist_id' => $psychologist->id, // Adicione isso aqui
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'birthdate' => $request->input('birthdate'),
            'cpf' => $request->input('cpf'),
            'description' => $request->input('description'),
        ]);

        $patient->save();

        return redirect()->back()->with('success', 'Paciente criado com sucesso.');
    }

    public function search(Request $request)
    {
        $psychologist = Auth::guard('psychologist')->user();
        $query = $request->input('query');
        $patients = Patient::where('psychologist_id', $psychologist->id)
            ->where('name', 'LIKE', "%$query%")
            ->get();

        return response()->json($patients);
    }
}

