<div class="modal fade" id="editNews{{ $a->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit News</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('news.update', $a->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row text-center mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" value="{{ $a->image }}"
                                class="form-control @error('image') is-invalid @enderror" id="basic-default-name">
                        </div>
                    </div>
                    <div class="row text-center mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" value="{{ $a->title }}"
                                class="form-control @error('title') is-invalid @enderror" id="basic-default-name">
                        </div>
                    </div>
                    <div class="row text-center mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">News Content</label>
                        <div class="col-sm-10">
                            <textarea id="content1" type="text" name="news_content"
                                class="form-control @error('news_content') is-invalid @enderror" id="basic-default-name">{{$a->news_content}}</textarea>
                            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
                            <script>
                                var konten = document.getElementById("content1");
                                CKEDITOR.replace(konten, {
                                    language: 'en-gb'
                                });
                                CKEDITOR.config.allowedContent = true;
                            </script>
                        </div>
                    </div>
                    <div class="row text-center mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-message">News Content</label>
                        <div class="col-sm-10">
                            <select class="form-select form-select-lg" name="category_id" id="basic-default-message">
                                <option selected>Pilih Kategori</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
