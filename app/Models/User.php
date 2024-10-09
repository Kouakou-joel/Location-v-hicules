<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pieces_identite_permis', 'phone', 'created_at ', 'updated_at ',
         'is_verified ', 'activation_code ', 'activation_token ', 'role_id '
    ];
     // Définir les rôles
     public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isStaff() {
        return $this->role === 'staff';
    }

    public function isClient() {
        return $this->role === 'client';
    }

    /**
     * Les attributs qui doivent être cachés pour les tableaux.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $username="email";
    protected $password="password";
}
