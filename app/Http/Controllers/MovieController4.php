<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController4 extends Controller
{
    //
    public function index(){
        return view("movie.index");
    }

    public function store(Request $request) {
        $request->validate([
            'movie_name' => 'required',
            'movie_name_vn' => 'required',
            'release_date'  => 'required|date_format:Y-m-d',
            'description'   => 'required',
            'image'         => 'required|image',
        ], [
            'required'    => ':attribute không được để trống.',
            'image'       => ':attribute phải là định dạng file ảnh.',
            'date_format' => ':attribute phải có định dạng yyyy-mm-dd.',
        ], [
            'movie_name' => 'Tên tiếng Anh',
            'movie_name_vn' => 'Tên tiếng Việt',
            'release_date'  => 'Ngày phát hành',
            'description'   => 'Mô tả',
            'image'         => 'Ảnh đại diện',
        ]);

        $imageName = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->extension();
            $file->storeAs('', $imageName, 'public');
        }

        DB::table('movie')->insert([
            'movie_name' => $request->movie_name,
            'movie_name_vn' => $request->movie_name_vn,
            'original_name' => $request->movie_name,
            'release_date'  => $request->release_date,
            'overview_vn'   => $request->description,
            'image'         => $imageName, 
            'status'        => 1,
        ]);

        return redirect()->back()->with('success', 'Thêm phim mới thành công!');
    }
    public function create()
    {
        return view('add_movie'); 
        }
}
