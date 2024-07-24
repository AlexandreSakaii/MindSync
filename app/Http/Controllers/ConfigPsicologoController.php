<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionType;
use App\Models\SessionTime;
use Illuminate\Support\Facades\Auth;

class ConfigPsicologoController extends Controller
{
    public function index()
    {
        $psychologist = Auth::guard('psychologist')->user();
        $sessionTypes = SessionType::where('psychologist_id', $psychologist->id)->get();
        $sessionTimes = SessionTime::where('psychologist_id', $psychologist->id)->get();
        return view('ConfigPsicologo', compact('sessionTypes', 'sessionTimes'));
    }
}
