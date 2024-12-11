<?php

namespace App\Http\Controllers;

use App\Models\DocUpm;
use App\Models\Status;
use Illuminate\Http\Request;

class DocumentFilController extends Controller
{
    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Show the list of documents filtered by category slug
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    /******  25d8f7db-8c07-4e63-a225-37b561f40ccd  *******/
    public function index($slug)
    {
        $statues = Status::all();
        $docs = DocUpm::whereHas('category', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->paginate(10);
        // $currentPage = $docs->currentPage();

        // // Mengambil total halaman
        // $totalPages = $docs->lastPage();
        return view('layouts.admin.category.filter-category', [
            'docs' => $docs,
            'statuses' => $statues,
            'currentPage' => $docs->currentPage(),
            'totalPages' => $docs->lastPage()
        ]);
    }
}
