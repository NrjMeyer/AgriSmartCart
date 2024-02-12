<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'id_users';
    
    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'password',
        'adresse',
        'role',
        'photo',
    ];
    public function produits()
    {
        return $this->hasMany(Produit::class, 'id_users');
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class, 'id_users');
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class, 'id_users');
    }
}
