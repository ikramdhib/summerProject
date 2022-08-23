<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SousCategorie;
use Illuminate\Http\Request;

class SousCategorieController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api', ['except' =>['displayAll' , 'displayOne'
    ]]);
    }

    public function add (Request $request){

        $file = $request->file('photo');

        $path = $file->store('public/files');

        $catg= SousCategorie ::create([
            'path'=>$path,
            'photo'=>substr($path, 6),
            'nom'=>$request->nom,
            'categorie_id'=>$request->categorie_id
        ]);
        return response()->json([
            'image' => $path,
            'file' => $request->nom
        ]);
    }

    public function update (Request $request){
        
        $catg = SousCategorie::find($request->id);
        if($request->hasFile('photo')){
            $path=public_path('storage'.$catg->photo);
        }
        $new_path=$request->file('photo')->store('public/file');
        $data['path']=$new_path;
        $data['photo']=substr($new_path,6);
        if($request->nom!=""){
            $data['nom']=$request->nom;
        }
        
        $isUpdated=$catg->update($data);
        return response()->json([
            "update"=>$isUpdated,
            'categorie'=>$catg
        ]);
    }

    public function destroy ($id){
        $catg= SousCategorie::find($id);
      $isDeleted=  $catg->delete();
      return response()->json([
          "deleted"=>$isDeleted
      ]);
    }


    public function displayAll(){
        $catgs=SousCategorie::all();
        return response()->json([
            'categories'=>$catgs
        ]);
    }


    public function displayOne($id){
        $catg=SousCategorie::find($id);
        return response()->json([
            "categorie"=>$catg
        ]);
    }

}
