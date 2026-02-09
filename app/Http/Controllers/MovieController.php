<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource as ResourcesMovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getAllMovies(){
        return ResourcesMovieResource::collection(
        Movie::with('genres')->paginate(10)
    );
    }
}
