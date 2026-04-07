
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
  .movie-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
            line-height: 1.4;
            overflow: hidden;
        }

.movie-date {
            font-size: 12px;
            color: #777;
            margin: 0;
        }
</style>
    <x-slot name="title">Trang chủ</x-slot>

    <div class="list-movie">
        @foreach($movies as $movie)
            <div class="movie">
                <img src="{{ Storage::url($movie->image) }}" style="width:100%">
                
                <div class="movie-info">
                    <p class="movie-title">{{ $movie->movie_name_vn }}</p>
                    
                    <p class="movie-date">{{ \Carbon\Carbon::parse($movie->release_date)->format('d/m/Y') }}</p>
                </div>
            </div>
        @endforeach
    </div>
</x-movie-layout>