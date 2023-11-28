@extends('admin.layout.app')
@section('content')
    <div class="container mt-3">
        <div class="card">
            <form action="{{ route('root.commentRoot.index') }}" method="GET">
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
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Komentar</th>
                            <th>Status</th>
                            <th>Berita</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comment as $c)
                            <tr>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.userRoot.show', $c['user']->email) }}">{{ $c['user']->username }}</a>
                                </td>
                                <td>{{ $c->text }}</td>
                                <td>{{ $c->status }}</td>
                                <td>
                                    <a class="text-decoration-underline"
                                        href="{{ route('root.newsRoot.show', $c['news']->title) }}">{{ $c['news']->title }}</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($c->created_at)->formatLocalized('%d %B %y') }}</td>
                                <td>
                                    <form onsubmit="return confirm('Yakin ingin menghapus komentar?')"
                                        action="{{ route('root.commentRoot.destroy', $c->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bx bx-trash me-1"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <h4>tidak ada komentar</h4>
                        @endforelse
                    </tbody>
                </table>
                <div class="m-3">
                    {{ $comment->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
