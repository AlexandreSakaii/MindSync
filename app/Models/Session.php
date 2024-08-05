<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychologist_id',
        'session_type',  // Adiciona session_type aos campos fillable
        'date',
        'start_time',
        'end_time',
        'status'
    ];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'session_patient');
    }
    public function sessionType()
    {
        return $this->belongsTo(SessionType::class, 'session_type', 'name');
    }
}
