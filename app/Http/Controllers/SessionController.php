<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        \Log::info("Dados recebidos no store: ", $request->all());

        $request->validate([
            'session_type' => 'required|string',
            'patient_ids' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'session_time' => 'required|integer',
        ]);

        $psychologist = Auth::guard('psychologist')->user();

        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $sessionTimeInMinutes = (int) $request->input('session_time');
        $endTime = $startTime->copy()->addMinutes($sessionTimeInMinutes);

        $session = Session::create([
            'psychologist_id' => $psychologist->id,
            'session_type' => $request->input('session_type'), // Corrigido para adicionar o tipo de sessão
            'date' => $request->input('date'),
            'start_time' => $startTime->format('H:i'),
            'end_time' => $endTime->format('H:i'),
        ]);

        $patientIds = explode(',', $request->input('patient_ids'));
        $session->patients()->attach($patientIds);

        return response()->json(['success' => true]);
    }



    public function update(Request $request, $id)
    {
        $session = Session::find($id);

        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        $validatedData = $request->validate([
            'session_type' => 'sometimes|required|string',
            'start_time' => 'sometimes|required|date_format:H:i',
            'session_time' => 'sometimes|required|integer',
            'end_time' => 'sometimes|required|date_format:H:i',
            'patient_id' => 'sometimes|required|exists:patients,id',
            'date' => 'required|date',
        ]);

        $session->update($validatedData);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $psychologist = Auth::guard('psychologist')->user();
        $session = Session::where('psychologist_id', $psychologist->id)->where('id', $id)->firstOrFail();

        $session->delete();

        return response()->json(['success' => true]);
    }

    public function getSessionsByDate(Request $request)
    {
        $date = $request->input('date');
        $psychologist = Auth::guard('psychologist')->user();

        \Log::info("Fetching sessions for date: {$date}");

        $sessions = Session::where('psychologist_id', $psychologist->id)
            ->where('date', $date)
            ->with('patients', 'sessionType') // Carrega a relação com SessionType
            ->orderBy('start_time')
            ->get();

        \Log::info("Sessions fetched: " . $sessions->toJson());

        $sessions->transform(function ($session) {
            return [
                'id' => $session->id,
                'start_time' => Carbon::createFromFormat('H:i:s', $session->start_time)->format('H:i'),
                'end_time' => Carbon::createFromFormat('H:i:s', $session->end_time)->format('H:i'),
                'patients' => $session->patients->map(function ($patient) {
                    return [
                        'name' => $patient->name,
                        'phone' => $patient->number,
                    ];
                }),
                'session_type' => $session->session_type,
                'color' => $session->sessionType ? $session->sessionType->color : '#FFFFFF' // Inclui a cor do tipo de sessão, com fallback para branco
            ];
        });

        \Log::info("Transformed sessions: " . $sessions->toJson());

        return response()->json($sessions);
    }
}
