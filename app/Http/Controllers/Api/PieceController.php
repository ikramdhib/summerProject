<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Piece;
use App\Models\SousCategorie;
use App\Models\SousSousCategorie;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api', ['except' =>['displayAll' , 'displayOne'
    ]]);
    }

    public function add (Request $request){

        $this->validate($request,[
            'nom'=>'required',
            'marque'=>'required',
            'ref'=>'required',
            'desc_brev'=>'required',
            'desc'=>'required',
            'photo'=>'required'
        ]);
        $file = $request->file('photo');
        $path = $file->store('public/files');
        $piece=new Piece([
            'nom'=>$request->nom,
            'marque'=>$request->marque,
            'ref'=>$request->ref,
            'desc_brev'=>$request->desc_brev,
            'desc'=>$request->desc,
            'prix'=>$request->prix,
            'indice_vs'=>$request->indice_vs,
            'constant'=>$request->constat,
            'path'=>$path,
            'photo'=>substr($path, 6)
        ]);

        if($request->commande_id){
            $commande=Commande::find($request->commande_id);
            $commande->pieces()->save($piece);
        }
        else if($request->categorie_id){
            $categorie=Categorie::find($request->categorie_id);
            $categorie->pieces()->save($piece);
        }
        else if($request->sous_categorie_id){
            $sous_catg=SousCategorie::find($request->sous_categorie_id);
            $sous_catg->pieces()->save($piece);
        }
        else if($request->souss_sous_categorie_id){
            $sous_sous_catg=SousSousCategorie::find($request->sous_sous_categorie_id);
            $sous_sous_catg->pieces()->save($piece);
        }
        return response()->json([
            'succes'=>true,
            'piece'=>$piece
        ]);
    }

    public  function update (Request $request){
        $piece = Piece::find($request->id);
        if($request->hasFile('photo')){
            $path=public_path('storage'.$piece->photo);
        }
        $new_path=$request->file('photo')->store('public/file');
        $data['path']=$new_path;
        $data['photo']=substr($new_path,6);
        if($request->nom!=""){
            $data['nom']=$request->nom;
        }
        if($request->marque!=""){
            $data['marque']=$request->marque;
        }
        if($request->ref!=""){
            $data['ref']=$request->ref;
        }
        if($request->desc!=""){
            $data['desc']=$request->desc;
        }
        if($request->desc_brev!=""){
            $data['desc_brev']=$request->desc_brev;
        }
        if($request->indice_vs!=""){
            $data['indice_vs']=$request->indice_vs;
        }
        if($request->constant!=""){
            $data['constant']=$request->constant;
        }
        if($request->prix!=""){
            $data['prix']=$request->prix;
        }
        
        $isUpdated=$piece->update($data);
        return response()->json([
            "update"=>$isUpdated,
            'piece'=>$piece
        ]);
    }

    public function delete($id){
        $piece=Piece::find($id);
        $isDeleted =  $piece->delete();

        return response()->json([
            "isDeleted"=>$isDeleted
        ]);
    }

    public function displayAll(){
        $pieces=Piece::all();
        return response()->json([
            'pieces'=>$pieces
        ]);
    }


    public function displayOne($id){
        $piece=Piece::find($id);
        return response()->json([
            "piece"=>$piece
        ]);
    }
}
