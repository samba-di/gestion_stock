<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $fillable = ['date_entree', 'date_sortie', 'quantite_entree', 'quantite_sortie', 'produit_id'];
}
