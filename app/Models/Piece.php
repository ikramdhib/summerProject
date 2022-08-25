<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    protected $fillable=[
        'nom', 'marque' ,'prix', 'ref', 'desc_brev', 'desc' ,'indice-vs', 'constant','path','photo'
    ];

    public function pieceable(){
        return $this->morphTo();
    }
}
