<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'transaction_id',
        'amount',
        'payement_methode',
        'payement_status',
        'date',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
