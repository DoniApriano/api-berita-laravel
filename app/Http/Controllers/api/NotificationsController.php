<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationsResource;
use App\Models\Follow;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function showNotifications()
    {
        $userId = Auth::user()->id;
        $follow = Follow::where("user_id", $userId)->get();
        // $notif = Notification::where("user_id", $follow[0]['following'])->get();
        // for ($i = 0; $i < count($follow);) {
        //     return new NotificationsResource(true, 'Berhasil fetch', [$follow[$i++]]);
        //     $i++;
        // }
        $notif = [];
        foreach ($follow as $follower) {
            $notif = Notification::where("user_id", $follower['following'])->get();
        }
        return new NotificationsResource(true, 'Berhasil fetch', $notif);
    }
}
