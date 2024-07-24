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
            'patient_id' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'session_time' => 'required|integer',
        ]);

        $psychologist = Auth::guard('psychologist')->user();

        $startTime = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $sessionTimeInMinutes = (int) $request->input('session_time');
        $endTime = $startTime->copy()->addMinutes($sessionTimeInMinutes);

        $patientIds = explode(',', $request->input('patient_id'));

        foreach ($patientIds as $patientId) {
            Session::create([
                'psychologist_id' => $psychologist->id,
                'patient_id' => $patientId,
                'session_type' => $request->input('session_type'),
                'date' => $request->input('date'),
                'start_time' => $startTime->format('H:i'),
                'end_time' => $endTime->format('H:i'),
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function getSessionsByDate(Request $request)
    {
        $date = $request->input('date');
        $psychologist = Auth::guard('psychologist')->user();

        \Log::info("Fetching sessions for date: {$date}");

        $sessions = Session::where('psychologist_id', $psychologist->id)
            ->where('date', $date)
            ->orderBy('start_time')
            ->get()
            ->unique(function ($item) {
                return $item['start_time'] . $item['end_time'];
            });

        \Log::info("Sessions fetched: " . $sessions->toJson());

        $sessions->transform(function ($session) {
            return [
                'start_time' => Carbon::createFromFormat('H:i:s', $session->start_time)->format('H:i'),
                'end_time' => Carbon::createFromFormat('H:i:s', $session->end_time)->format('H:i')
            ];
        });

        \Log::info("Transformed sessions: " . $sessions->toJson());

        return response()->json($sessions);
    }
}
