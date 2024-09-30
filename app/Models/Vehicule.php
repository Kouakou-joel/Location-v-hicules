<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'make_id',
        'type_vehicule_id',
        'year',
        'price_per_day',
        'location',
        'availability',
        'dscription',
        'images',
        'capacite',
        'transmission',
        'taille_coffre',
        'consommation_moyenne',

    ];
}
