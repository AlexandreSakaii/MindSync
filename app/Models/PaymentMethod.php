<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_name',
        'card_number',
        'card_expiration',
        'cvv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = Crypt::encryptString($value);
    }

    public function setCardExpirationAttribute($value)
    {
        $this->attributes['card_expiration'] = Crypt::encryptString($value);
    }

    public function setCvvAttribute($value)
    {
        $this->attributes['cvv'] = Crypt::encryptString($value);
    }
}
