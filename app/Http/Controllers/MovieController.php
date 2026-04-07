<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index()
    {
        $movies = DB::table('movie')
            ->where('status', 1)
            ->select(
                'id',
                'image_link',
                'movie_name_vn',
                'movie_name',
                'original_name',
                'overview_vn',
                'overview',
                'release_date',
                'vote_average'
            )
            ->orderBy('release_date', 'desc')
            ->get();

        return view('movie.index', compact('movies'));
    }
}
