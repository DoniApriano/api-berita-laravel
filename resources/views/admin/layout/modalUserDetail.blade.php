<div class="modal fade" id="userDetail{{ $a->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Detail Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card m-3">
                    <div class="row m-3">
                        <div class="col text-center">
                            <img class="rounded " width="200"
                                src="{{ asset('/storage/userProfilePicture/' . $a->profile_picture) }}">
                        </div>
                        <div class="col m-3">
                            <h6 class="">Username : {{ $a->username }}</h6>
                            <p>Jumlah Mengikuti : <button data-bs-toggle="modal"
                                    data-bs-target="#following{{ $a->id }}"
                                    class="btn btn-primary">{{ $following[$a->id] }}</button></p>
                            <p>Jumlah Pengikut : <button data-bs-toggle="modal"
                                    data-bs-target="#followers{{ $a->id }}"
                                    class="btn btn-primary">{{ $followers[$a->id] }}</button></p>
                            <p>Jumlah dipostingan : {{ $news[$a->id] }}</p>
                            <p>Bergabung : {{ \Carbon\Carbon::parse($a->created_at)->formatLocalized('%d %B %y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Isi Berita</th>
                                <th>Kategori</th>
                                <th>Komentar</th>
                                <th>Asksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($allNews[$a->id] as $an)
                                <tr>
                                    <td>
                                        <img width="" src="{{ asset('/storage/newsImage/' . $an->image) }}"
                                            class="img-fluid rounded-3 w-75" alt="">
                                    </td>
                                    <td>{{ $an->title }}</td>
                                    <td>
                                        <p>@php
                                            $article = $an->news_content;
                                            $limitedArticle = Str::limit($article, $limit = 10, $end = '...');
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
                                        <button type="button" class="btn btn-success comment-button"
                                            data-bs-toggle="modal" data-bs-target="#commentNews{{ $an->id }}"
                                            data-newsid="{{ $an->id }}">Comment</button>
                                    </td>
                                    <td>
                                        <form action="{{ route('root.newsRoot.destroy', $an->id) }}"
                                            onsubmit="return confirm('Yakin?')" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash me-1"></i></button>
                                        </form>

                                        @include('admin.layout.modalNews')
                                    </td>
                                </tr>
                            @empty
                                <div class="text-center">
                                    <h6 class="">Belum ada berita</h6>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($allNews[$a->id] as $an)
    @include('admin.layout.modalComment')
@endforeach
@include('admin.layout.modalFollowers')
@include('admin.layout.modalFollowing')
