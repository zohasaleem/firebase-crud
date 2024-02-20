<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/firebase');
});


//Firebase
Route::get('/firebase', [UserController::class,'index']);
Route::get('/firebase/users-list', [UserController::class,'getList']);

Route::get('new-user', [UserController::class,'create']);

Route::post('add-user', [UserController::class,'store']);

Route::get('edit-user/{id}', [UserController::class,'edit']);
Route::put('update-user/{id}', [UserController::class,'update']);
Route::get('delete-user/{id}',[UserController::class,'destroy']);
