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
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Isi</th>
                            <th>Tanggale</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($submission as $r)
                            <tr>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.userRoot.show', $r['user']->email) }}">{{ $r['user']->username }}</a>
                                </td>
                                <td>{{ $r->text }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($r->created_at)->formatLocalized('%d %B %y') }}
                                </td>
                                <td>
                                    <button button class="btn btn-warning bx bxs-pen" type="button"
                                        data-bs-target="#submission{{ $r->id }}" data-bs-toggle="modal"></button>
                                    @include('admin.layout.modalSubmission')
                                </td>
                            </tr>
                        @empty
                            <div class="text-center">
                                <h4>Tidak ada laporan</h4>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
