@extends("partials/layout")

@section("main")
    @if(Session::has('success'))
    <div class="bg-green-700 text-white text-center text-sm px-3 py-1 rounded">
        {{ Session::get('success') }}
    </div>
    @endif

    <section class="flex flex-row justify-between gap-3 py-3">
        <form class="form-group" action="/" method="GET">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan judul" value="{{ request()->query('search') }}" />
        </form>

        <a href="{{ route('home.create') }}" class="btn btn-primary">Tambah</a>
    </section>

    <section class="card">
        <table class="table w-full">
            <thead>
                <tr>
                    <th class="text-left">
                        Judul 

                        @if($order === 'ASC')
                        <a href="{{ request()->fullUrlWithQuery(['order' => 'DESC', 'sort' => 'title']) }}">
                             &uarr;
                        </a>
                        @elseif($order === 'DESC')
                            <a href="{{ request()->fullUrlWithQuery(['order' => null, 'sort' => 'title']) }}">
                                &darr;
                            </a>
                        @else
                            <a href="{{ request()->fullUrlWithQuery(['order' => 'ASC', 'sort' => 'title']) }}">
                                &udarr;
                            </a>
                        @endif
                    </th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Pengarang</th>
                    <th class="text-center">Kategori</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $record)
                <tr>
                    <td>{{ $record->title }}</td>
                    <td class="text-center">{{ $record->year }}</td>
                    <td class="text-center">{{ $record->author->name }}</td>
                    <td class="text-center">{{ $record->category->name }}</td>
                    <td>
                        <div class="flex flex-row justify-end items-center gap-2">
                            <a href="{{ route('home.edit', [ 'id' => $record->id ]) }}" class="text-gray-500 border border-gray-500 px-2 rounded-full text-sm">edit</a>
                            <a href="{{ route('home.delete', [ 'id' => $record->id ]) }}" class="text-red-500 border border-red-500 px-2 rounded-full text-sm">hapus</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <section class="py-3">
        <div class="pagination flex flex-row items-center justify-between">
            <a
                @if(is_null($books->appends(request()->query())->previousPageUrl())) 
                    href="javascript:;"
                    class="btn btn-default rounded-full !text-gray-300 !border-gray-300 cursor-default hover:!ring-0 active:!bg-transparent"
                @else
                    href="{{ $books->appends(request()->query())->previousPageUrl() }}"
                    class="btn btn-default rounded-full"
                @endif
            >< Sebelumnya</a>
            <a
                @if(is_null($books->appends(request()->query())->nextPageUrl())) 
                    href="javascript:;"
                    class="btn btn-default rounded-full !text-gray-300 !border-gray-300 cursor-default hover:!ring-0 active:!bg-transparent"
                @else
                    href="{{ $books->appends(request()->query())->nextPageUrl() }}"
                    class="btn btn-default rounded-full"
                @endif
            >Selanjutnya ></a>
        </div>
    </section>
@endsection