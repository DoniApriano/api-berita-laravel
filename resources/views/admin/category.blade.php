@extends('admin.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            @if (Session::has('success'))
                <div id="myalert" class="alert alert-success alert-dismissible" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body">
                <form action="{{ route('root.categoryRoot.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="basic-default-name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($category as $c)
                            <tr>
                                <td>
                                    {{ $c->name }}
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Yakin ingin menghapus komentar?')"
                                        action="{{ route('root.categoryRoot.destroy', $c->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bx bx-trash me-1"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="text-center">
                                <h4>Tidak ada Kateogri</h4>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
