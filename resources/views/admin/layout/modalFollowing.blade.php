<div class="modal fade" id="following{{ $a->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Detail Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Foto Profil</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($allFollowing[$a->id] as $afng)
                                <tr>
                                    <td>
                                        <img class="rounded" width="150"
                                            src="{{ asset('/storage/userProfilePicture/' . $afng['followings']->profile_picture) }}">
                                    </td>
                                    <td>
                                        <p>{{ $afng['followings']->username }}</p>
                                    </td>
                                </tr>
                            @empty
                                <div class="text-center">
                                    <h6 class="">Belum ada followers</h6>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
