<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychologist_id', // Adicione isso aqui
        'name',
        'number',
        'birthdate',
        'cpf',
        'description',
    ];

    public function psychologist()
    {
        return $this->belongsTo(Psychologist::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class, 'session_patient');
    }
}

