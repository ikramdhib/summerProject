<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avi extends Model
{
    protected $fillable=[
        'cmnt', 'etoile' , 'user_id', 'piece_id'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Piece(){
        return $this->belongsTo(Piece::class);
    }
}
