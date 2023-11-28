<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubmissionResource;
use App\Models\SubmissionRequest;
use App\Models\SubmissionRespond;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "text" => "required"
        ]);

        $submission = SubmissionRequest::create([
            "user_id" => Auth::user()->id,
            "text" => $request->text,
        ]);

        return new SubmissionResource(true, "Berhasil store", $submission);
    }

    public function show()
    {
        $userId = Auth::user()->id;

        $submission = SubmissionRespond::with("user","submissionRequest")->where("user_id",$userId)->get();

        return new SubmissionResource(true, "Berhasil fetch",$submission);
    }
}
