@extends('admin.layout.app')

@section('content')
    <div class="container mt-3">
        <div class="col-xxl">
            <div class="card">
                @if (Session::has('success'))
                    <div id="myalert" class="alert alert-success alert-dismissible" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('root.userRoot.index') }}" method="GET">
                    <div class="row m-3">
                        <div class="col-9">
                            <input type="text" class="form-control shadow-none" name="search" placeholder="Search..."
                                aria-label="Search...">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
                <div class="mx-3">
                    <a href="{{ route('root.print') }}"  class="btn btn-success">Cetak</a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Gambar Profil</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Tanggal Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($users as $a)
                                <tr>
                                    <td>
                                        <img width="100px"
                                            src="{{ asset('/storage/userProfilePicture/' . $a->profile_picture) }}"
                                            class="img-fluid rounded-circle" alt="">
                                    </td>
                                    <td>{{ $a->username }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($a->created_at)->formatLocalized('%d %B %y') }}</td>
                                    <td>
                                        <form action="{{ route('root.userRoot.destroy', $a->id) }}"
                                            onsubmit="return confirm('Yakin?')" method="post">
                                            <button type="button" data-bs-target="#userDetail{{ $a->id }}"
                                                data-bs-toggle="modal" class="btn btn-primary">Detail</button>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash me-1"></i></button>
                                        </form>
                                        @include('admin.layout.modalUserDetail')
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
                    <div class="m-3">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
