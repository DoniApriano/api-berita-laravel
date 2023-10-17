@extends('admin.layout.app')
@section('content')
    <div class="container mt-3">
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
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
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
                                <textarea id="content" type="text" name="news_content"
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
                                <select class="form-select form-select-lg" name="category_id" id="basic-default-message">
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
        <div class="col-xxl">
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>News Content</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($news as $a)
                                <tr>
                                    <td>
                                        <img width="300px" src="{{ asset('/storage/newsImage/' . $a->image) }}"
                                            class="img-fluid rounded-3" alt="">
                                    </td>
                                    <td>{{ $a->title }}</td>
                                    <td>
                                        <p>@php
                                            $article = $a->news_content;
                                            $limitedArticle = Str::limit($article, $limit = 50, $end = '...');
                                            $replacedText = str_replace('contoh', 'contoh lain', $limitedArticle);
                                        @endphp

                                            {{ $replacedText }}</p>
                                    </td>
                                    @foreach ($category as $c)
                                        @if ($c->id === $a->category_id)
                                            <td>{{ $c->name }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <form action="{{ route('news.destroy', $a->id) }}"
                                            onsubmit="return confirm('Yakin?')" method="post">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#editNews{{ $a->id }}"><i
                                                    class="bx bx-edit-alt me-2"></i></button>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash me-1"></i></button>
                                        </form>
                                        @include('admin.layout.modalNews')
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger alert-dismissible" id="myalert" role="alert">
                                    Data Kosong
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
