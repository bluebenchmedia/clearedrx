<?php

use App\Http\Controllers\FormsortController;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::post('/formsort', [FormsortController::class, 'submit']);