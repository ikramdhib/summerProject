<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable=[
        'path', 'photo' , 'nom'
    ];


    public function SousCategories(){
        return $this->hasMany(SousCategorie::class);
    }
    public function Pieces(){
        return $this->morphMany(Piece::class,'pieceable');
    }
}
