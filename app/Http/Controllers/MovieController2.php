<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController2 extends Controller
{
    public function chitiet($id)
    {
        $movie = DB::table('movie')->where('id', $id)->first();
        $genre = DB::table('genre')->get();

        if (! $movie) {
            abort(404);
        }

        return view('movie.chitiet', compact('movie', 'genre'));
    }
}
