<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'clinic_name',
        'cnpj',
        'password',
        'phone',
        'responsible_cpf',
        'responsible_name',
        'city',
        'state',
        'country',
        'cep',
        'street',
        'number',
        'complement',
        'plan_name',
        'plan_value',
        'quantidadePsicologos',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
