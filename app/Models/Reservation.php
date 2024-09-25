<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'vehicule_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le modèle Vehicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }
}

