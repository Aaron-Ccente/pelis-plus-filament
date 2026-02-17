<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('api/movies', [MovieController::class, 'getAllmoviesAPI']);
Route::get('api/actors', [ActorController::class, 'getActors']);