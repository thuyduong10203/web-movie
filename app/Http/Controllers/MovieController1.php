<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController1 extends Controller
{
    public function index(Request $request)
    {
        $genre = DB::table('genre')->get();
        $id_theloai = $request->route('id');
        $query = DB::table('movie'); 

if ($id_theloai) {
$movies = DB::table('movie as m')
    ->join('movie_genre as mg', 'm.id', '=', 'mg.id_movie')
    ->where('mg.id_genre', $id_theloai)
    ->select('m.*') 
    ->orderBy('m.release_date', 'desc')
    ->take(12)
    ->get();
    } else {
        $movies = DB::table('movie')
                        ->where('popularity', '>', 450)
                        ->where('vote_average', '>', 7)
                        ->orderBy('release_date', 'desc')
                        ->take(12)
                        ->get();
    }

    return view('movie.index', compact('movies', 'genre'));
    }
}
