<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SousSousCategorie;
use Illuminate\Http\Request;

class SousSousCategoriesController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth:api', ['except' =>['displayAll' , 'displayOne'
    ]]);
    }

    public function add (Request $request){

        $file = $request->file('photo');

        $path = $file->store('public/files');

        $catg= SousSousCategorie ::create([
            'path'=>$path,
            'photo'=>substr($path, 6),
            'nom'=>$request->nom,
            'sous_categorie_id'=>$request->sous_categorie_id
        ]);
        return response()->json([
            'image' => $path,
            'file' => $request->nom
        ]);
    }

    public function update (Request $request){
        
        $catg = SousSousCategorie::find($request->id);
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
            'room'=>$catg
        ]);
    }

    public function destroy ($id){
        $catg= SousSousCategorie::find($id);
      $isDeleted=  $catg->delete();
      return response()->json([
          "deleted"=>$isDeleted
      ]);
    }


    public function displayAll(){
        $catgs=SousSousCategorie::all();
        return response()->json([
            'categories'=>$catgs
        ]);
    }


    public function displayOne($id){
        $catg=SousSousCategorie::find($id);
        return response()->json([
            "categorie"=>$catg
        ]);
    }
}
