@extends("partials/layout")

@section("main")
    <section class="w-[500px] mx-auto">
        <form action="{{ route('home.update', [ 'id' => $data->id ]) }}" method="POST" class="flex flex-col gap-3">
            @csrf

            <h3 class="text-xl text-center text-gray-500">Edit</h3>

            <div class="form-group">
                <label for="title">Judul</label>
                <input id="title" name="title" type="text" class="form-control" value="{{ old('title', $data->title) }}" />
                @error("title")
                <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="author_id">Pengarang</label>
                <select id="author_id" name="author_id"class="form-control" value="{{ old('author_id', $data->author_id) }}">
                    <option>Pilih pengarang</option>
                    @foreach($authors as $author)
                    <option value="{{ $author->id }}" @if($author->id == old('author_id', $data->author_id)) selected @endif>
                        {{ $author->name }}
                    </option>
                    @endforeach
                </select>
                @error("author_id")
                <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">Tahun</label>
                <input id="year" name="year" type="number" class="form-control" value="{{ old('year', $data->year) }}" />
                @error("year")
                <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id"class="form-control" value="{{ old('category_id', $data->category_id) }}">
                    <option>Pilih kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($category->id == old('category_id', $data->category_id)) selected @endif>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error("category_id")
                <div class="text-sm text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-row justify-between items-center">
                <a href="{{ route('home') }}" class="text-blue-500 underline" tabindex="-1">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </section>
@endsection