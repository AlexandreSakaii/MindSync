<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Psychologist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PsychologistController extends Controller
{
    public function create(Request $request)
    {
        $manager = Auth::user();
        $psychologistCount = Psychologist::where('manager_id', $manager->id)->count();

        if ($psychologistCount >= $manager->quantidadePsicologos) {
            return redirect()->back()->withErrors(['limit' => 'Você atingiu o limite de psicólogos permitidos pelo seu plano.']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'crm_crp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:psychologists',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $psychologist = new Psychologist([
            'name' => $request->input('name'),
            'crm_crp' => $request->input('crm_crp'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $psychologist->manager_id = $manager->id;
        $psychologist->save();

        return redirect()->back()->with('success', 'Psychologist created successfully.');
    }

    public function index()
    {
        $manager_id = Auth::id();
        $psychologists = Psychologist::where('manager_id', $manager_id)->get();
        $psychologistCount = $psychologists->count();
        $maxPsychologists = Auth::user()->quantidadePsicologos;
        $remainingPsychologists = $maxPsychologists - $psychologistCount;

        return view('MenagerAuth', compact('psychologists', 'remainingPsychologists'));
    }

}

