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
    $data = Movie::with('genres')->paginate(10);
    return ResourcesMovieResource::collection($data);
    }
}
