<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CommentReport;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootReportController extends Controller
{
    public function index()
    {
        $report = CommentReport::where('status','unresponded')->get();
        $pageTitle = "Halaman Laporan";
        $user = Auth::user();
        $profilePicture = $user->profile_picture;
        return view("admin.report",compact(["report","pageTitle","profilePicture"]));
    }

    public function update($id)
    {
        $commentReports = CommentReport::findOrFail($id);
        $commentReports->update([
            "status"=> "responded"
        ]);

        return back()->with("success","Berhasil menanggapi laporan");
    }
}
