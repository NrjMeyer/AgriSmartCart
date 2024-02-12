<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produit';
    protected $fillable = [
        'nom_produit',
        'description',
        'prix',
        'stock',
        'moq',
        'type_unite',
        'id_categorie',
        'id_users',
        'created_at',
        'etat', 
    ];

}
