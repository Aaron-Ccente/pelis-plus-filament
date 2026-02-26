<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('actors', [ActorController::class, 'getActors']);
Route::prefix('movies')->controller(MovieController::class)->group(function(){
    Route::get('/', 'getAllmoviesAPI');
    Route::post('/stars', 'setStarMovie');
});