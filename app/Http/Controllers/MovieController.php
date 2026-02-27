<?php

namespace App\Http\Controllers;

use App\Http\Requests\StarMovieRequest;
use App\Http\Resources\MovieResource as ResourcesMovieResource;
use App\Models\Movie;
use App\Models\Star;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getAllmoviesAPI(){
    $movies = Movie::with(['genres'])
        ->latest()
        ->paginate(perPage: 20);

    return ResourcesMovieResource::collection($movies)
        ->response()
        ->setStatusCode(200);
    }

    public function setStarMovie(StarMovieRequest $request){
    $request->validated();

    $star = Star::updateOrCreate(
        [
            'movie_id' => $request->movie_id,
            'user_id' => $request->user_id,
        ],
        [
            'star_number' => $request->star_number,
        ]
    );

    return response()->json([
        'message' => 'Calificación guardada correctamente',
        'data' => $star,
    ]);
    }
}
