<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RootPrintController extends Controller
{
    public function print()
    {
        $users = User::get();

        $pdf = Pdf::loadView('admin.print',['users' => $users]);
        return $pdf->stream('Laporan-Data-User.pdf');
    }
}
