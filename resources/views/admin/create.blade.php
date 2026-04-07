@extends('layouts.app')

@section('content')
<div class="container-fluid px-0">
    <div class="position-relative mb-4">
        <img src="{{ asset('images/banner.jpg') }}" class="w-100" style="height: 320px; object-fit: cover;" alt="Banner">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white"
            style="background: rgba(0, 0, 0, 0.45);">
            <div class="text-center px-3">
                <h1 class="display-4 fw-bold">Thêm phim mới</h1>
                <p class="lead mb-0">Bạn có thể thêm thông tin phim mới tại đây.</p>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <div class="bg-dark text-white p-3" style="width: 260px; min-height: 100vh;">
            <h5 class="mb-3"><i class="bi bi-film"></i> Thể loại phim</h5>
            <ul class="list-unstyled">
                @foreach($genres ?? [] as $genre)
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">{{ $genre->genre_name_vn }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex-grow-1 p-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4">Thêm phim mới</h2>
                    <p class="text-muted">Hiện tại trang tạo phim chưa có form nhập liệu đầy đủ. Bạn có thể quay lại danh sách phim để tiếp tục.</p>
                    <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">← Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
