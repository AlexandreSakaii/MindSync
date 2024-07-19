<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Psychologist extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'crm_crp', 'email', 'password', 'manager_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
