<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api', ['except' =>['displayAll' , 'displayOne'
    ]]);
    }

    public function add( Request $request){
        $this->validate($request,[
            'marque'=>'required',
            'modele'=>'required'
        ]);

        $voiture=Voiture::create([
            'marque'=>$request->marque,
            'modele'=>$request->modele
        ]);

        return response()->json([
            'message'=>"success",
            'voiture'=>$voiture
        ]);

    }

    public function delete($id){
        $voiture=Voiture::find($id);
        $isDeleted=$voiture->delete();

        return response()->json([
            'isDeleted'=>$isDeleted
        ]);
    }

    public function displayAll(){
        $voitures=Voiture::all();
        return response()->json([
            'voitures'=>$voitures
        ]);
    }
    

    public function displayOne($id){
        $voiture=Voiture::find($id);
        return response()->json([
            'voiture'=>$voiture
        ]);
    }
}
