<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategorieController;

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