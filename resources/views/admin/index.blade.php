@extends('admin.layout.app')
@section('content')
    <div class="container p-5">
        <div class="order-0">
            <div class="card p-5">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h1 class="card-title text-primary">Selamat Datang {{ $username }}! 🎉</h1>
                            <p class="mb-4">
                                Sebarkan berita tanpa adanya <span class="fw-bold">HOAX 👍</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
