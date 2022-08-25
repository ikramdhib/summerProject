<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable=[
        'quantite', 'totale_prix', 'etat' , 'user_id' , 'facture_id'
    ];

   public function User(){
       return $this->belongsTo(User::class);
   }
   public function Factures(){
    return $this->hasMany(Facture::class);
}
}
