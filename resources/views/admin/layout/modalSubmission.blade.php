<div class="modal fade" id="submission{{ $r->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Beri Tanggapan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('root.submissionRoot.update', $r->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="text-center">
                        <textarea placeholder="Respon" id="contentNews" type="text" name="respond" rows="10"
                            class="form-control @error('respond') is-invalid @enderror" id="basic-default-name"></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
