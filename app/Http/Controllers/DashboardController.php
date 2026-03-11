<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocUpm;
use App\Models\Status;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    
    public function dashboard()
    {
        // Menghitung jumlah dokumen dengan status tertentu
        $countDraftDocuments = DocUpm::join('status', 'doc_upms.status_id', '=', 'status.id')
                                ->where('status.name', 'Draft')
                                ->count();
        $countUploadedDocuments = DocUpm::join('status', 'doc_upms.status_id', '=', 'status.id')
                                ->where('status.name', 'Uploaded')
                                ->count();
        $totalDocs = DocUpm::count();
        // Mendapatkan tanggal satu tahun yang lalu
        $oneYearAgo = Carbon::now()->subYear();

        // Mengambil data jumlah dokumen dengan status tertentu per bulan dalam satu tahun
        $documentsData = DocUpm::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                                ->where('created_at', '>=', $oneYearAgo)
                                ->groupBy('month')
                                ->get();

        return view('layouts.admin.dashboard.index', compact('countDraftDocuments', 'countUploadedDocuments','documentsData','totalDocs'));
    }
}
