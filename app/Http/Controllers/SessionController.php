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
        $request->validate([
            'session_type' => 'required|string',
            'patient_ids' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'session_time' => 'required|integer',
        ]);

        $psychologist = Auth::guard('psychologist')->user();

        \Log::info("Guard utilizado: ", ['guard' => 'psychologist']);
        \Log::info("Usuário autenticado: ", ['user' => $psychologist]);

        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $sessionTimeInMinutes = (int) $request->input('session_time');
        $endTime = $startTime->copy()->addMinutes($sessionTimeInMinutes);

        $patientIds = explode(',', $request->input('patient_ids'));

        foreach ($patientIds as $patientId) {
            Session::create([
                'psychologist_id' => $psychologist->id,
                'patient_id' => $patientId,
                'session_type' => $request->input('session_type'),
                'date' => $request->input('date'),
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endTime->format('H:i'),
            ]);

            \Log::info("Sessão criada para paciente: ", ['patient_id' => $patientId]);
        }

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
            ->with('patient')
            ->orderBy('start_time')
            ->get();

        \Log::info("Sessions fetched: " . $sessions->toJson());

        $sessions->transform(function ($session) {
            return [
                'id' => $session->id,
                'start_time' => Carbon::createFromFormat('H:i:s', $session->start_time)->format('H:i'),
                'end_time' => Carbon::createFromFormat('H:i:s', $session->end_time)->format('H:i'),
                'patient_name' => $session->patient->name,
                'patient_phone' => $session->patient->number,
                'session_type' => $session->session_type,
                'session_duration' => Carbon::createFromFormat('H:i:s', $session->start_time)->diffInMinutes(Carbon::createFromFormat('H:i:s', $session->end_time)),
            ];
        });

        \Log::info("Transformed sessions: " . $sessions->toJson());

        return response()->json($sessions);
    }
}
