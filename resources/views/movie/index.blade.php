
<x-movie-layout>
    <style>
        .movie-info {
            padding: 10px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .movie {
            display: block;
            color: inherit;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .movie:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        }

        .movie-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            line-height: 1.4;
            overflow: hidden;
            transition: color 0.2s ease;
        }

        .movie:hover .movie-title {
            color: #1ca9d6;
        }

        .movie-date {
            font-size: 12px;
            color: #777;
            margin: 0;
            transition: color 0.2s ease;
        }

        .movie:hover .movie-date {
            color: #333;
        }
    </style>
    <x-slot name="title">Trang chủ</x-slot>

    @if(isset($keyword))
        <div style="margin-bottom: 20px;">
            <h3>Kết quả tìm kiếm: "{{ $keyword }}"</h3>
            @if($movies->isEmpty())
                <p>Không tìm thấy bộ phim nào phù hợp với từ khóa.</p>
            @endif
        </div>
    @endif

    <div class="list-movie">
        @foreach($movies as $movie)
            <a class="movie" href="{{ url('/movie/' . $movie->id) }}">
                <img src="{{ Storage::url($movie->image) }}" style="width:100%">

                <div class="movie-info">
                    <p class="movie-title">{{ $movie->movie_name_vn }}</p>
                    <p class="movie-date">{{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</p>
                </div>
            </a>
        @endforeach
    </div>
</x-movie-layout>