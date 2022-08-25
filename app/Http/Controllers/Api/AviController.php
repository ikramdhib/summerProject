<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Avi;
use Illuminate\Http\Request;

class AviController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api', ['except' =>['displayAll' , 'displayOne'
    ]]);
    }

    public function add( Request $request){
        $this->validate($request,[
            'cmnt'=>'required',
            'etoile'=>'required'
        ]);

        $avi=Avi::create([
            'cmnt'=>$request->cmnt,
            'etoile'=>$request->etoile,
            'user_id'=>$request->user_id,
            'piece_id'=>$request->piece_id
            
        ]);

        return response()->json([
            'message'=>"success",
            'avi'=>$avi
        ]);

    }

    public function delete($id){
        $avi=avi::find($id);
        $isDeleted=$avi->delete();

        return response()->json([
            'isDeleted'=>$isDeleted
        ]);
    }

    public function displayAll(){
        $avi=Avi::all();
        return response()->json([
            'avis'=>$avi
        ]);
    }
    

    public function displayOne($id){
        $avi=Avi::find($id);
        return response()->json([
            'avi'=>$avi
        ]);
    }
}
