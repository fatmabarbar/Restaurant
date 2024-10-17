<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['numero', 'date', 'total', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')->withPivot('quantite');
    }
}
