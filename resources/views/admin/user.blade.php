@extends('admin.layout.app')

@section('content')
    <div class="container mt-3">
        <div class="col-xxl">
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Profile Picture</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Date Join</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($user as $a)
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
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash me-1"></i></button>
                                        </form>
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
