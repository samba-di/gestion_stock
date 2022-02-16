<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'quantite'];
    public function Stock()
        {

         return $this->belongto(Stock::class);
        }
}
