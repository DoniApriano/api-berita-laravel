@extends('admin.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pelapor</th>
                            <th>Terlapor</th>
                            <th>Komentar</th>
                            <th>Judul Berita</th>
                            <th>Pengirim Berita</th>
                            <th>Perihal</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($report as $r)
                            <tr>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.userRoot.show', $r['reporter']->email) }}">{{ $r['reporter']->username }}</a>
                                </td>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.userRoot.show', $r['reported']->email) }}">{{ $r['reported']->username }}</a>
                                </td>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.commentRoot.show', $r['comment']->text) }}">{{ $r['comment']->text }}</a>
                                </td>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.newsRoot.show', $r['comment']['news']->title) }}">{{ $r['comment']['news']->title }}</a>
                                </td>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.userRoot.show', $r['comment']['news']['user']->email) }}">{{ $r['comment']['news']['user']->username }}</a>
                                </td>
                                <td>
                                    {{ $r->description }}
                                <td>
                                    {{ \Carbon\Carbon::parse($r->created_at)->formatLocalized('%d %B %y') }}
                                </td>
                                <td>
                                    <button button class="btn btn-warning bx bxs-pen" type="button"
                                        data-bs-target="#respond{{ $r->id }}" data-bs-toggle="modal"></button>
                                    @include('admin.layout.modalRespond')
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
