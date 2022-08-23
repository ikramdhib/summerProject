<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousSousCategorie extends Model
{
    protected $fillable=[
        'path', 'photo' , 'nom' , 'sous_categorie_id'
    ];

    public function SousCategorie(){
        return $this->belongsTo(SousCategorie::class);
    }
}
