<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'psychologist_id',
        'name',
        'color', // Adiciona isso aqui
    ];
}
