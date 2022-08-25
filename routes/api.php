<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\FactureController;
use App\Http\Controllers\Api\SousCategorieController;
use App\Http\Controllers\Api\SousSousCategoriesController;
use App\Http\Controllers\Api\VoitureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 
//user login , registerd nd logout 
Route::group([
    'middleware'=>'api',
    'prefix'=>'user'
],
function ($router){
Route::post('/login',[AuthController::class,  'login']);
Route::post('/register',[AuthController::class , 'register']);
Route::get('/profile',[AuthController::class , 'userProfile']);
Route::post('/logout', [AuthController::class, 'logout']);

}
);


//Categorie CRUD
Route::post('/addCatg',[CategorieController::class, 'add']);
Route::post('/updateCatg/{id}', [CategorieController::class , 'update']);
Route::delete('/deleteCatg/{id}',[CategorieController::class,'destroy']);
Route::get('/categories',[CategorieController::class, 'displayAll']);
Route::get('/categorie/{id}',[CategorieController::class,'displayOne']);

//sousCategorie CRUD
Route::post('/addSousCatg',[SousCategorieController::class, 'add']);
Route::post('/updateSousCatg/{id}', [SousCategorieController::class , 'update']);
Route::delete('/deleteSousCatg/{id}',[SousCategorieController::class,'destroy']);
Route::get('/sousCategories',[SousCategorieController::class, 'displayAll']);
Route::get('/SousCategorie/{id}',[SousCategorieController::class,'displayOne']);


//SousSousCategories CRUD
Route::post('/addSousSousCatg',[SousSousCategoriesController::class, 'add']);
Route::post('/updateSousSousCatg/{id}', [SousSousCategoriesController::class , 'update']);
Route::delete('/deleteSousSousCatg/{id}',[SousSousCategoriesController::class,'destroy']);
Route::get('/sousSousCategories',[SousSousCategoriesController::class, 'displayAll']);
Route::get('/sousSousCategorie/{id}',[SousSousCategoriesController::class,'displayOne']);


//Voiture CRUD
Route::post('/addVoiture',[VoitureController::class, 'add']);
Route::delete('/deleteVoiture/{id}',[VoitureController::class , 'delete']);
Route::get('/voitures',[VoitureController::class, 'displayAll']);
Route::get('/voiture/{id}',[VoitureController::class, 'displayOne']);


//Facture CRUD
Route::post('/addFacture',[FactureController::class, 'add']);
Route::delete('/deleteFacture/{id}',[FactureController::class , 'delete']);
Route::get('/factures',[FactureController::class, 'displayAll']);
Route::get('/facture/{id}',[FactureController::class, 'displayOne']);