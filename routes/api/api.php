<?php

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/' , function(){
    return response() -> json([
        'id' => 1,
        'name' => 'sharif',
        'courses' => ['math','arabic', 'english' ,'key' => 'value']
    ]) -> header('Content-Type' , 'application/json');
});

Route::get('/test' , function(){
    return response('hello');
});

Route::group(['middleware' => ['printTest']] , function(){
    
    Route::get('/test1' , function(Request $request) {
        if ($request -> attributes -> get('value') == 10){
            return 'yes';
        }
        else {
            return 'no';
        }
    });

});
