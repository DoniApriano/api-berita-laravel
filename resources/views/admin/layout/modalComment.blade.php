<div class="modal fade" id="commentNews{{ $a->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @php
                use App\Models\Comment;
                use App\Models\User;
                $comment = Comment::where('news_id', $a->id)->get();
            @endphp
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Comment Text</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comment as $c)
                                @php
                                    $userComment = User::where('id', $c->user_id)->get();
                                @endphp
                                <tr>
                                    <td>{{ User::find($c->user_id)->username }}</td>
                                    <td>{{ $c->text }}</td>
                                    <td><button type="button" class="btn btn-primary">Button</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
