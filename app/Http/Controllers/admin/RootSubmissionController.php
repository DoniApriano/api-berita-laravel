<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubmissionRequest;
use App\Models\SubmissionRespond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootSubmissionController extends Controller
{
    public function index()
    {
        $submission = SubmissionRequest::where('status', 'true')->get();
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = "Semua Permintaan";
        return view('admin.submission', compact(['profilePicture', 'pageTitle', 'submission']));
    }

    public function update(Request $request, $id)
    {
        $submissionRequest = SubmissionRequest::findOrFail($id);

        $submissionRequest->status = "false";
        $submissionRequest->save();

        if (!$submissionRequest) {
            return back()->with("success", "gagal Merespon");
        }

        $createRespond = SubmissionRespond::create([
            "submission_request_id" => $id,
            "user_id" => $submissionRequest->user_id,
            "text" => $request->respond,
        ]);

        return back()->with("success", "Berhasil Merespon");
    }
}
