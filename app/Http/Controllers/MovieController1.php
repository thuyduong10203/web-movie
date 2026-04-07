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

    public function search(Request $request)
    {
        $keyword = trim($request->input('keyword'));
        $genre = DB::table('genre')->get();

        if ($keyword === '') {
            $movies = DB::table('movie')
                ->where('popularity', '>', 450)
                ->where('vote_average', '>', 7)
                ->orderBy('release_date', 'desc')
                ->take(12)
                ->get();
        } else {
            $movies = DB::table('movie')
                ->where(function ($query) use ($keyword) {
                    $query->where('movie_name', 'like', "%{$keyword}%")
                        ->orWhere('movie_name_vn', 'like', "%{$keyword}%")
                        ->orWhere('original_name', 'like', "%{$keyword}%")
                        ->orWhere('overview', 'like', "%{$keyword}%")
                        ->orWhere('overview_vn', 'like', "%{$keyword}%")
                        ->orWhere('tagline', 'like', "%{$keyword}%")
                        ->orWhere('tagline_vn', 'like', "%{$keyword}%");
                })
                ->orderBy('release_date', 'desc')
                ->get();
        }

        return view('movie.index', compact('movies', 'genre', 'keyword'));
    }
}
