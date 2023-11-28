@extends('admin.layout.app')
@section('content')
    <div class="container mt-3">
        @if (Auth::user()->role == 'normal')
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Tambah News</h5>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success'))
                            <div id="myalert" class="alert alert-success alert-dismissible" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{ route('normal.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" id="basic-default-name">
                                </div>
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title"
                                        class="form-control @error('name') is-invalid @enderror" id="basic-default-name">
                                </div>
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">News Content</label>
                                <div class="col-sm-10">
                                    <textarea id="contentNews" type="text" name="news_content"
                                        class="form-control @error('news_content') is-invalid @enderror" id="basic-default-name"></textarea>
                                </div>
                                @error('news_content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">News Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-lg" name="category_id"
                                        id="basic-default-message">
                                        <option selected>Pilih Kategori</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row justify-content-end mt-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
        @endif
        <div class="col-xxl">
            <div class="card">
                @if (Auth::user()->role == 'root')
                    @if (Session::has('success'))
                        <div id="myalert" class="alert alert-success alert-dismissible" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('root.newsRoot.index') }}" method="GET">
                        <div class="row m-3">
                            <div class="col-5">
                                <input type="text" class="form-control shadow-none" name="search"
                                    placeholder="Search..." aria-label="Search...">
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <select class="form-select form-select" name="category" id="">
                                        <option selected>Semua Kategori</option>
                                        @foreach ($category as $cs)
                                            <option value="{{ $cs->name }}">{{ $cs->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                @else
                @endif
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Isi Berita</th>
                                <th>Kategori</th>
                                <th>Komentar</th>
                                @if (Auth::user()->role == 'root')
                                    <th>Pengirim</th>
                                @endif
                                <th>Asksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($news as $an)
                                <tr>
                                    <td>
                                        <img width="300px" src="{{ asset('/storage/newsImage/' . $an->image) }}"
                                            class="img-fluid rounded-3" alt="">
                                    </td>
                                    <td>{{ $an->title }}</td>
                                    <td>
                                        <p>@php
                                            $article = $an->news_content;
                                            $limitedArticle = Str::limit($article, $limit = 50, $end = '...');
                                            $replacedText = str_replace('contoh', 'contoh lain', $limitedArticle);
                                        @endphp
                                            {{ $replacedText }}</p>
                                    </td>
                                    @foreach ($category as $c)
                                        @if ($c->id === $an->category_id)
                                            <td>{{ $c->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <button type="button" class="btn btn-success comment-button" data-bs-toggle="modal"
                                            data-bs-target="#commentNews{{ $an->id }}"
                                            data-newsid="{{ $an->id }}">Comment</button>
                                        @include('admin.layout.modalComment')
                                    </td>
                                    @if (Auth::user()->role == 'root')
                                        <td>
                                            @foreach ($author as $at)
                                                @if ($at->id == $an->user_id)
                                                    {{ $at->username }}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td>
                                        @if (Auth::user()->role == 'normal')
                                            <form action="{{ route('normal.news.destroy', $an->id) }}"
                                                onsubmit="return confirm('Yakin?')" method="post">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#editNews{{ $an->id }}"><i
                                                        class="bx bx-edit-alt me-2"></i></button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bx bx-trash me-1"></i></button>
                                            </form>
                                        @else
                                            <form action="{{ route('root.newsRoot.destroy', $an->id) }}"
                                                onsubmit="return confirm('Yakin?')" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="bx bx-trash me-1"></i></button>
                                            </form>
                                        @endif
                                        @include('admin.layout.modalNews')
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger alert-dismissible" id="myalert" role="alert">
                                    News is empty
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="m-3">
                        {{ $news->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
