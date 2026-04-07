<x-movie-layout>
    <x-slot name="title">
        Danh sách phim
    </x-slot>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">DANH SÁCH PHIM</h2>
                <a href="{{ route('admin.movies.create') }}" class="btn btn-success btn-sm">Thêm</a>
            </div>

            <div class="table-responsive">
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
                        @forelse($movies as $movie)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ $movie->image_link }}" width="70" class="img-thumbnail" style="border-radius: 8px;">
                                </td>
                                <td class="align-middle">
                                    <strong>{{ $movie->movie_name_vn ?? $movie->movie_name }}</strong><br>
                                    <small class="text-muted">{{ $movie->original_name ?? '' }}</small>
                                </td>
                                <td class="align-middle">
                                    {{ \Illuminate\Support\Str::limit($movie->overview_vn ?? $movie->overview ?? 'Chưa có mô tả', 120) }}
                                </td>
                                <td class="text-center align-middle">
                                    {{ $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') : 'Chưa có' }}
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
                                    <a href="{{ route('admin.movies.show', $movie->id) }}" class="btn btn-primary btn-sm me-1">Xem</a>
                                    <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa phim này?')">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Chưa có phim nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            if ($.fn.DataTable) {
                $('#movieTable').DataTable({
                    responsive: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50, 100],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/vi.json'
                    },
                    columnDefs: [
                        { orderable: false, targets: [0, 5] }
                    ]
                });
            }
        });
    </script>
</x-movie-layout>