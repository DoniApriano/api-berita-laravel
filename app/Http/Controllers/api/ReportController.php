<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\CommentReport;
use App\Models\NewsReport;
use App\Models\Report;
use App\Models\ReportRespond;
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
            "status" => "unresponded",
        ]);

        return new ReportResource(true, 'Berhasil Lapor', [
            $report,
            'reporter' => CommentReport::with('reporter')->get(),
            'reported' => CommentReport::with('reported')->get(),
        ]);
    }

    public function showReportForReported()
    {
        $userId = Auth::user()->id;
        $report = ReportRespond::with("reported", "comment.news", "commentReport")->where('reported_user_id', $userId)->latest()->get();
        return new ReportResource(true, "Berhasil fetch", $report);
    }
    public function showReportForReporter()
    {
        $userId = Auth::user()->id;
        $report = ReportRespond::with("reporter", "comment.news", "commentReport")->where('reporter_user_id', $userId)->latest()->get();
        return new ReportResource(true, "Berhasil fetch", $report);
    }
}
