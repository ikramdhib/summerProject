<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api', ['except' =>['displayAll' , 'displayOne'
    ]]);
    }

    public function add( Request $request){
        
        $user=User::find($request->user_id);
        if($user->role=='USER'){
        $this->validate($request,[
            'quantite'=>'required',
            'totale_prix'=>'required',
            'etat'=>'required'
        ]);

        $commande=Commande::create([
            'quantite'=>$request->quantite,
            'totale_prix'=>$request->totale_prix,
            'etat'=>$request->etat,
            'user_id'=>$request->user_id,
            'facture_id'=>$request->facture_id
        ]);

        return response()->json([
            'message'=>"success",
            'commande'=>$commande
        ]);
        }
        else{
            return response()->json([
                'error'=>"Unauthorized Access"
            ]); 
        }
    }

    public function delete($id){
        $commande=Commande::find($id);
        $isDeleted=$commande->delete();

        return response()->json([
            'isDeleted'=>$isDeleted
        ]);
    }

    public function displayAll(){
        $commandes=Commande::all();
        return response()->json([
            'commandes'=>$commandes
        ]);
    }
    

    public function displayOne($id){
        $commande=Commande::find($id);
        return response()->json([
            'commandes'=>$commande
        ]);
    }

  
}
