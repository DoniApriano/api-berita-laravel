<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\CommentReport;
use App\Models\NewsReport;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function reportComment(Request $request)
    {
        $this->validate(request(), [
            "reported_user_id" => "required",
            "comment_id" => "required",
            "description" => "required",
        ]);

        $report = CommentReport::create([
            "reporter_user_id" => Auth::user()->id,
            "reported_user_id" => $request->reported_user_id,
            "comment_id" => $request->comment_id,
            "description" => $request->description,
        ]);

        return new ReportResource(true, 'Berhasil Lapor', [
            $report,
            'reporter' => CommentReport::with('reporter', 'id,username')->get(),
            'reported' => CommentReport::with('reported', 'id,username')->get(),
        ]);
    }

    public function reportNews(Request $request)
    {
        $this->validate(request(), [
            "reported_user_id" => "required",
            "news_id" => "required",
            "description" => "required",
        ]);

        $report = NewsReport::create([
            "reporter_user_id" => Auth::user()->id,
            "reported_user_id" => $request->reported_user_id,
            "news_id" => $request->news_id,
            "description" => $request->description,
        ]);

        return new ReportResource(true, 'Berhasil Lapor', [
            $report,
            'reporter' => NewsReport::with('reporter', 'id,username')->get(),
            'reported' => NewsReport::with('reported', 'id,username')->get(),
        ]);
    }
}
