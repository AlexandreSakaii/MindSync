<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychologist_id',
        'time_in_minutes',
    ];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }
}
