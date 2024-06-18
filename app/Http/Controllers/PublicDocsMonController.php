<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DocUpm;
use App\Models\Status;
use Illuminate\Pagination\Paginator;
use App\Models\DocFile;


class PublicDocsMonController extends Controller
{
    // public function index(Request $request)
    // {
    //     $data['title'] = 'Unit Permormance Monitoring';
    //     $search = $request->input('search');
    //     // Retrieve documents paginated and ordered by creation date descending
    //     $docs = DocUpm::orderBy('created_at', 'desc')
    //         ->where('dm_number', 'like', '%'.$search.'%')
    //         ->orWhere('subject', 'like', '%'.$search.'%')
    //         ->orWhere('user', 'like', '%'.$search.'%')
    //         ->get();

    //     // Retrieve all statuses
    //     $statuses = Status::all();

    //     // Mengambil nomor halaman saat ini
    //     // $currentPage = $docs->currentPage();
        
    //     // // Mengambil total halaman
    //     // $totalPages = $docs->lastPage();
        
    //     return view('layouts.public.index', compact('docs', 'statuses','data'));
    // }
    public function index(Request $request)
    {
        $data['title'] = 'Unit Performance Monitoring';
        $search = $request->input('search');

        // Retrieve status ID for 'approved'
        $approvedStatus = Status::where('name', 'approved')->first();

        // Retrieve documents paginated and ordered by creation date descending
        $docs = DocUpm::where('status_id', $approvedStatus->id)
            ->where(function($query) use ($search) {
                $query->where('dm_number', 'like', '%'.$search.'%')
                      ->orWhere('subject', 'like', '%'.$search.'%')
                      ->orWhere('user', 'like', '%'.$search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Retrieve all statuses
        $statuses = Status::all();

        return view('layouts.public.index', compact('docs', 'statuses', 'data'));
    }
}
