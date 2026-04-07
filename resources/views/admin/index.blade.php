@extends('layouts.app')

@section('content')
    <div class="container-fluid px-0">
        <!-- Banner -->
        <div class="position-relative">
            <img src="{{ asset('images/banner.jpg') }}" class="w-100" style="height: 320px; object-fit: cover;"
                alt="Banner">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white"
                style="background: rgba(0, 0, 0, 0.45);">
                <div class="text-center px-3">
                    <h1 class="display-4 fw-bold">Welcome.</h1>
                    <p class="lead mb-0">Millions of movies, TV shows and people to discover. Explore now.</p>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <!-- Sidebar Thể loại -->
            <div class="bg-dark text-white p-3" style="width: 260px; min-height: 100vh;">
                <h5 class="mb-3"><i class="bi bi-film"></i> Thể loại phim</h5>
                <ul class="list-unstyled">
                    @foreach($genres ?? [] as $genre)
                        <li class="mb-2">
                            <a href="#" class="text-white text-decoration-none">
                                {{ $genre->genre_name_vn }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Nội dung chính: Danh sách phim -->
            <div class="flex-grow-1 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0"> DANH SÁCH PHIM</h2>
                </div>
                <div class="mb-3">
                    <a href="{{ route('admin.movies.create') }}" class="btn btn-success">
                        Thêm
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <table id="movieTable" class="table table-bordered table-hover align-middle" style="width:100%">
                            <thead class="table-light text-center">
                                <tr>
                                    <th style="width: 10%">Ảnh đại diện</th>
                                    <th style="width: 20%">Tiêu đề</th>
                                    <th style="width: 35%">Giới thiệu</th>
                                    <th style="width: 15%">Ngày phát hành</th>
                                    <th style="width: 10%">Điểm đánh giá</th>
                                    <th style="width: 10%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movies as $movie)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ $movie->image_link }}" width="70" class="img-thumbnail"
                                                style="border-radius: 8px;">
                                        </td>
                                        <td class="align-middle">
                                            <strong>{{ $movie->movie_name_vn ?? $movie->movie_name }}</strong><br>
                                            <small class="text-muted">{{ $movie->original_name ?? '' }}</small>
                                        </td>
                                        <td class="align-middle">
                                            {{ \Illuminate\Support\Str::limit($movie->overview_vn ?? $movie->overview ?? 'Chưa có mô tả', 120) }}
                                        </td>
                                        <td class="text-center align-middle">
                                            {{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') ?? 'Chưa có' }}
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($movie->vote_average)
                                                <span class="badge bg-warning text-dark fs-6">
                                                    ⭐ {{ number_format($movie->vote_average, 1) }}
                                                </span>
                                            @else
                                                <span class="text-muted">Chưa có</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('admin.movies.show', $movie->id) }}"
                                                class="btn btn-primary btn-sm">Xem</a>
                                            <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Bạn có chắc muốn xóa phim này?')">
                                                    Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#movieTable').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                bStateSave: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json'
                },
                columnDefs: [
                    { orderable: false, targets: [0, 5] } // không sắp xếp cột ảnh và hành động
                ]
            });
        });
    </script>
@endsection