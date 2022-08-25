<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\User;
use Illuminate\Http\Request;

class FactureController extends Controller
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
            'ref'=>'required',
        ]);

        $facture=Facture::create([
            'ref'=>$request->ref,
            'user_id'=>$request->user_id
        ]);

        return response()->json([
            'message'=>"success",
            'facture'=>$facture
        ]);
        }
        else{
            return response()->json([
                'error'=>"Unauthorized Access"
            ]); 
        }
    }

    public function delete($id){
        $facture=Facture::find($id);
        $isDeleted=$facture->delete();

        return response()->json([
            'isDeleted'=>$isDeleted
        ]);
    }

    public function displayAll(){
        $factures=Facture::all();
        return response()->json([
            'factures'=>$factures
        ]);
    }
    

    public function displayOne($id){
        $facture=Facture::find($id);
        return response()->json([
            'facture'=>$facture
        ]);
    }
}
