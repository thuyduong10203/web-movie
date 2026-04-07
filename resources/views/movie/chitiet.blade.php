<x-movie-layout>
    <x-slot name="title">
        {{ $movie->movie_name_vn ?: $movie->movie_name }}
    </x-slot>

    @php
        $posterUrl = $movie->image_link ?: Storage::url($movie->image);
        $backdropUrl = $movie->backdrop_link ?: Storage::url($movie->backdrop);
        $releaseDate = $movie->release_date ? \Carbon\Carbon::parse($movie->release_date)->format('Y-m-d') : 'N/A';
        $runtime = $movie->runtime ? $movie->runtime . ' phút' : 'N/A';
        $revenue = $movie->revenue ? number_format($movie->revenue) : 'N/A';
        $country = $movie->country_name ?: ($movie->country_code ?: 'N/A');
        $overview = $movie->overview_vn ?: $movie->overview ?: 'Chưa có mô tả.';
        $tagline = $movie->tagline_vn ?: $movie->tagline;
    @endphp


    <main class="movie-detail-container">
        <div class="movie-detail-card">
            <div class="movie-detail-poster">
                <img src="{{ $posterUrl }}" alt="{{ $movie->movie_name_vn ?: $movie->movie_name }}">
            </div>

            <div class="movie-detail-info">
                <h2>{{ $movie->movie_name_vn ?: $movie->movie_name }}</h2>

                <div class="movie-detail-meta">
                    Ngày phát hành: <strong>{{ $releaseDate }}</strong> <br>
                    Quốc gia: <strong>{{ $country }}</strong><br>
                    Thời gian: <strong>{{ $runtime }}</strong><br>
                    Doanh thu: <strong>{{ $revenue }}</strong><br>
                    @if($movie->vote_average)
                        Điểm đánh giá: <strong>{{ $movie->vote_average }}</strong>
                    @endif
                </div>

                <div class="movie-detail-description">
                    <h3>Mô tả:</h3>
                    <p>{{ $overview }}</p>
                </div>

                @if($movie->trailer)
                    <a href="{{ $movie->trailer }}" class="btn btn-success movie-detail-button" target="_blank">Xem trailer</a>
                @endif
            </div>
        </div>
    </main>

    <style>

        .movie-detail-container {
            max-width: 1200px;
            margin: 40px auto 80px;
            padding: 0 20px;
        }

        .movie-detail-card {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .movie-detail-poster {
            flex: 0 0 340px;
            min-width: 280px;
            background: #111;
        }

        .movie-detail-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .movie-detail-info {
            flex: 1;
            padding: 32px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .movie-detail-info h2 {
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 2rem;
            line-height: 1.1;
            color: #111;
        }

        .movie-detail-meta {
            gap: 14px 48px;
            margin-bottom: 28px;
            color: #030303;
        }

        .movie-detail-meta div span {
            display: inline-block;
            min-width: 120px;
            font-weight: 600;
            color: #222;
        }

        .movie-detail-description h3 {
            margin-bottom: 12px;
            font-size: 1.15rem;
            color: #111;
        }

        .movie-detail-description p {
            line-height: 1.8;
            color: #555;
        }

        .movie-detail-button {
            margin-top: 26px;
            padding: 12px 24px;
            font-size: 0.95rem;
            border-radius: 30px;
        }

        @media (max-width: 900px) {
            .movie-detail-hero {
                padding: 45px 16px;
            }

            .movie-detail-card {
                flex-direction: column;
            }

            .movie-detail-poster {
                width: 100%;
            }

            .movie-detail-meta {
                grid-template-columns: 1fr;
            }
        }
    </style>
</x-movie-layout>