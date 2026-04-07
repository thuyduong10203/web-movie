<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMovieController extends Controller
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

        $genres = DB::table('genre')
            ->select('id', 'genre_name_vn')
            ->get();

        return view('admin.index', compact('movies', 'genres'));
    }

    public function show($id)
    {
        $movie = DB::table('movie')
            ->where('id', $id)
            ->where('status', 1)
            ->firstOrFail();

        $genres = DB::table('genre')->get();

        return view('admin.show', compact('movie', 'genres'));
    }

    public function create()
    {
        $genres = DB::table('genre')
            ->select('id', 'genre_name_vn')
            ->get();

        return view('admin.create', compact('genres'));
    }

    public function destroy($id)
    {
        DB::table('movie')
            ->where('id', $id)
            ->update(['status' => 0]);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Đã xóa phim thành công');
    }
}