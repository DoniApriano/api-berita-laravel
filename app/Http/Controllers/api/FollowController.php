<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FollowResource;
use App\Models\Follow;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $this->validate($request, [
            'following' => 'required',
        ]);

        $follow = Follow::create([
            'user_id' => Auth::user()->id,
            'following' => $request->following,
        ]);

        $followingUserId = $request->following;

        $existingFollow = Follow::where('user_id', Auth::user()->id)
            ->where('following', $followingUserId)
            ->first();

        if ($existingFollow) {
            return new FollowResource(false, "Anda sudah follow user id $followingUserId", []);
        }


        return new FollowResource(true, 'Berhasil Follow', [
            $follow,
            'user_id' => User::where('id', Auth::user()->id)->get(),
            'following' => User::where('id', $request->following)->get()
        ]);
    }

    public function unFollow($id)
    {
        $follow = Follow::where('user_id', Auth::user()->id)->where('following', $id)->first();
        $follow->delete();
        return new FollowResource(true, 'Berhasil unfollow', []);
    }

    public function showFollowing($id)
    {
        $follow = Follow::where('user_id', $id)->with('following')->get();
        $countOfFolloweing = Follow::where('user_id', $id)->count();
        return new FollowResource(true, 'Berhasil fetch', ["following" => $follow, "count" => $countOfFolloweing]);
    }

    public function showFollowers($id)
    {
        $follow = Follow::where('following', $id)->with('followers')->get();
        $countOfFollowers = Follow::where('following', $id)->count();
        return new FollowResource(true, 'Berhasil fetch', ["followers" => $follow, "count" => $countOfFollowers]);
    }

    public function showFollowingByToken()
    {
        $follow = Follow::where('user_id', Auth::user()->id)->with('following')->get();
        $countOfFollowers = Follow::where('user_id', Auth::user()->id)->count();
        return new FollowResource(true, 'Berhasil fetch', ["followers" => $follow, "count" => $countOfFollowers]);
    }
    public function showFollowingNewsByToken()
    {
        $follow = Follow::where('user_id', Auth::user()->id)->with('following')->latest()->get();
        $news = [];
        foreach ($follow as $f) {
            $newsFollowing = News::where('user_id', $f->following)->with('user')->get();
            $news[$f->id] = $newsFollowing;
        }
        return new FollowResource(true, 'Berhasil fetch', $news);
    }

    public function checkIfFollowing($userId)
    {
        $isFollowing = Follow::where('user_id', Auth::user()->id)
            ->where('following', $userId)
            ->exists();

        if ($isFollowing) {
            return new FollowResource(true, "Anda sudah follow user", $isFollowing);
        }

        return new FollowResource(false, "Anda belum follow user", $isFollowing);
    }
}
