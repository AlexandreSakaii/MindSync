<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionType;
use App\Models\SessionTime;
use Illuminate\Support\Facades\Auth;

class SessionTimeController extends Controller
{
    public function index()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTimes = SessionTime::where('psychologist_id', $psychologist->id)->get();
        return view('ConfigPsicologo', compact('sessionTimes'));
    }

    public function showDeshboard()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTypes = SessionType::where('psychologist_id', $psychologist->id)->get();
        $sessionTimes = SessionTime::where('psychologist_id', $psychologist->id)->get();
        return view('Deshboard', compact('sessionTypes', 'sessionTimes'));
    }

    public function getSessionTimes()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTimes = SessionTime::where('psychologist_id', $psychologist->id)->get();
        return response()->json($sessionTimes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'time_in_minutes' => 'required|integer|min:1',
        ]);

        $psychologist = Auth::guard('psychologist')->user();

        SessionTime::create([
            'psychologist_id' => $psychologist->id,
            'time_in_minutes' => $request->input('time_in_minutes'),
        ]);

        return redirect()->back()->with('success', 'Tempo médio de sessão criado com sucesso.');
    }

    public function destroy($id)
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTime = SessionTime::where('psychologist_id', $psychologist->id)->findOrFail($id);
        $sessionTime->delete();

        return redirect()->back()->with('success', 'Tempo médio de sessão excluído com sucesso.');
    }
}
