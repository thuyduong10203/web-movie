<x-movie-layout>
    <x-slot name="title">
        Thêm phim
    </x-slot>

        @if ($errors->any())
            <div style='color:red;width:30%; margin:0 auto'>
                <div >
                    {{ __('Whoops! Something went wrong.') }}
                </div>
                
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style='text-align:center;font-weight:bold;color:#15c;font-size:30px;'>THÊM PHIM</div>
            <div class="form-group">
                <label>Tên tiếng Anh</label>
                <input type='text' name='movie_name' class='form-control' value="{{ old('movie_name') }}">
            </div>

            <div class="form-group">
                <label>Tên tiếng Việt</label>
                <input type='text' name='movie_name_vn' class='form-control' value="{{ old('movie_name_vn') }}">
            </div>

            <div class="form-group">
                <label>Ngày phát hành (yyyy-mm-dd)</label>
                <input type='text' name='release_date' class='form-control' placeholder='2005-12-08' value="{{ old('release_date') }}">
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name='description' class='form-control' rows="2">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type='file' name='image' class='form-control-file'>
            </div>

            <div style='text-align:center;'><input type='submit' class='btn btn-primary mt-1' value='Lưu'></div>
        </form>
</x-movie-layout>