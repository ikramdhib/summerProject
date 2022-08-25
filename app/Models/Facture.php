<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable=[
        'ref', 'user_id',
    ];


    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Commande(){
        return $this->belongsTo(Commande::class);
    }
}
