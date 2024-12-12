<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $category = Category::all();
        $data['title'] = 'Unit Performance Monitoring';
        $search = $request->input('search');

        // Retrieve documents where public_view is 1 from the Status table and filter by search terms
        $docs = DocUpm::join('status', 'doc_upms.status_id', '=', 'status.id')  // Join with Status table
            ->where('status.public_view', 1)  // Pastikan hanya yang public yang tampil
            ->where(function ($query) use ($search) {
                $query->where('dm_number', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%')
                    ->orWhere('user', 'like', '%' . $search . '%');
            })
            ->orderBy('doc_upms.created_at', 'desc')
            ->select('doc_upms.*')  // Ambil semua kolom dari tabel doc_upms
            ->paginate(10);  // Pagination

        // Retrieve all statuses (optional)
        $statuses = Status::all();

        return view('layouts.public.index', compact('docs', 'statuses', 'data', 'category'));
    }

    public function showFilter(Request $request, $slug)
    {


        // dd($slug);
        // Ambil kategori berdasarkan slug
        //
        $category = Category::all();
        // Pastikan kategori ditemukan, jika tidak tampilkan 404
        // if (!$category) {
        //     abort(404, 'Category not found');  // Jika kategori tidak ditemukan, tampilkan error 404
        // }

        $data['title'] = 'Unit Performance Monitoring';
        $search = $request->input('search');

         // Retrieve documents where public_view is 1 from the Status table and filter by search terms and category
        $docs = DocUpm::join('status', 'doc_upms.status_id', '=', 'status.id')
        ->where('status.public_view', 1)
        ->whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })
        ->when($search, function ($query) use ($search) {  // Apply search filter if search term exists
            $query->where(function ($q) use ($search) {
                $q->where('dm_number', 'like', '%' . $search . '%')
                    ->orWhere('subject', 'like', '%' . $search . '%')
                    ->orWhere('user', 'like', '%' . $search . '%');
            });
        })
            ->orderBy('doc_upms.created_at', 'desc')
            ->select('doc_upms.*')  // Ambil semua kolom dari tabel doc_upms
            ->paginate(10);  // Pagination
        // Pagination

        // Retrieve all statuses (optional)
        $statuses = Status::all();

        return view('layouts.public.index', compact('docs', 'statuses', 'data', 'category'));
    }
}
