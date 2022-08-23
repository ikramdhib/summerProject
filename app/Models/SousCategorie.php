<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousCategorie extends Model
{
    protected $fillable=[
        'path', 'photo' , 'nom', 'categorie_id'
    ];

    public function Categorie(){
        return $this->belongsTo(Categorie::class);
    }
    public function SousCategories(){
        return $this->hasMany(SousSousCategorie::class);
    }
}
