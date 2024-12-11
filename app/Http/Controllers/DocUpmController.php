<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\DocUpm;
use App\Models\DocFile;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use App\Notifications\DocumentCreated;
use Illuminate\Support\Facades\Crypt;

class DocUpmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-docsMon|edit-docsMon|delete-docsMon', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-docsMon', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-docsMon', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-docsMon', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        // Retrieve documents paginated and ordered by creation date descending
        $docs = DocUpm::orderBy('created_at', 'desc')
            ->where('dm_number', 'like', '%' . $search . '%')
            ->orWhere('subject', 'like', '%' . $search . '%')
            ->orWhere('user', 'like', '%' . $search . '%')
            ->paginate(10);

        // Retrieve all statuses
        $statuses = Status::all();

        // Mengambil nomor halaman saat ini
        $currentPage = $docs->currentPage();

        // Mengambil total halaman
        $totalPages = $docs->lastPage();

        return view('layouts.admin.upm.index', compact('docs', 'statuses', 'currentPage', 'totalPages',));
    }

    public function create()
    {
        $statuses = Status::all();
        $categories = Category::all();
        return view('layouts.admin.upm.create', compact('statuses', 'categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'dm_number' => 'required',
            'subject' => 'required',
            'user' => 'required',
            'tgldoc' => 'required|date_format:m/d/Y',
            'status_id' => 'required',
            'files.*' => 'required|mimes:pdf,doc,docx',
            'category_id' => 'required',
        ]);

        // // Konversi format tanggal ke 'YYYY-MM-DD'
        // $validatedData['tgldoc'] = Carbon::createFromFormat('m/d/Y', $validatedData['tgldoc'])->format('Y-m-d');
        // Konversi format tanggal ke 'Y-m-d' jika ada nilai yang dimasukkan
        if ($validatedData['tgldoc']) {
            $validatedData['tgldoc'] = Carbon::createFromFormat('m/d/Y', $validatedData['tgldoc'])->format('Y-m-d');
        }
        // Simpan data
        $doc = DocUpm::create($validatedData);

        // Upload dan simpan multiple files
        foreach ($request->file('files') as $file) {
            $fileName = $doc->id . '_' . time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/attachments', $fileName);

            // Simpan informasi file ke dalam tabel doc_files
            $docFile = new DocFile([
                'attachment_path' => $fileName,
            ]);

            // Simpan file terkait dengan dokumen
            $doc->files()->save($docFile);
        }

        // Kirim notifikasi ke pengguna yang perlu diberitahu
        // $usersToNotify = User::where('role', 'Doc Admin')->get();
        // foreach ($usersToNotify as $user) {
        //     $user->notify(new DocumentCreated($doc));
        // }


        return redirect()->route('docsMon.index')->with('success', '<div class="alert alert-primary" role="alert">
        <span class="fe fe-alert-circle fe-16 mr-2"></span> Add Successfully! </div>');
    }

    public function show(DocUpm $doc)
    {
        return view('docsMon.show', compact('doc'));
    }

    public function edit($encryptedId)
    {
        $statuses = Status::all();
        $id = Crypt::decrypt($encryptedId);
        // Logika untuk mengambil data dengan ID tertentu
        $doc = DocUpm::find($id);
        $categories = Category::all();
        return view('layouts.admin.upm.edit', compact('doc', 'statuses', 'categories'));
    }

    public function update(Request $request, DocUpm $doc, $encryptedId)
    {

        // Validasi input
        $validatedData = $request->validate([
            'dm_number' => 'required',
            'subject' => 'required',
            'user' => 'required',
            'tgldoc' => 'required|date_format:m/d/Y',
            'status_id' => 'required',
            'files.*' => 'nullable|mimes:pdf,doc,docx',
            'category_id' => 'required',
        ]);

        // Retrieve the record from the database
        $id = Crypt::decrypt($encryptedId);
        $doc = DocUpm::findOrFail($id);

        // Update the fields with new values
        $doc->dm_number = $request->input('dm_number');
        $doc->subject = $request->input('subject');
        $doc->user = $request->input('user');
        $doc->tgldoc = \Carbon\Carbon::createFromFormat('m/d/Y', $validatedData['tgldoc'])->format('Y-m-d');
        $doc->status_id = $request->input('status_id');

        // Perbarui data
        $doc->update();

        // Konversi format tanggal ke 'Y-m-d' jika ada nilai yang dimasukkan
        if ($validatedData['tgldoc']) {
            $validatedData['tgldoc'] = Carbon::createFromFormat('m/d/Y', $validatedData['tgldoc'])->format('Y-m-d');
        }

        // Simpan atau perbarui multiple file paths jika ada file yang diunggah
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileName = $doc->id . '_' . time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/attachments', $fileName);

                // Simpan informasi file atau perbarui attachment_path sesuai kebutuhan
                $doc->files()->create(['attachment_path' => $fileName]);
            }
        }



        return redirect()->back()->with('success', '<div class="alert alert-success" role="alert">
        <span class="fe fe-alert-octagon fe-16 mr-2"></span> Update Succesfully </div>');
    }

    public function destroy($encryptedId)
    {
        // Mengambil dokumen berdasarkan ID
        $id = Crypt::decrypt($encryptedId);
        $doc = DocUpm::findOrFail($id);

        // Menghapus file-file terlampir yang terkait dengan dokumen
        foreach ($doc->files as $file) {
            // Hapus file dari penyimpanan
            Storage::delete('public/attachments/' . $file->attachment_path);
            // Hapus record file dari database
            $file->delete();
        }

        // Hapus dokumen itu sendiri
        $doc->delete();

        return redirect()->route('docsMon.index')->with('success', '<div class="alert alert-danger" role="alert" >
        <span class="fe fe-minus-circle fe-16 mr-2"></span> Delete Successfully! </div>');
    }

    public function updateStatus(Request $request, $id)
    {
        $doc = DocUpm::findOrFail($id);

        // Misalnya, anggap status yang baru adalah ID status yang diinginkan (gantilah dengan logika bisnis Anda)
        $newStatusId = $request->input('status_id');

        // Update nilai status_id
        $doc->status_id = $newStatusId;

        // Simpan perubahan
        $doc->save();

        return redirect()->route('docsMon.index')->with('success', '<div class="alert alert-primary" role="alert">
        <span class="fe fe-alert-circle fe-16 mr-2"></span> Status Updated! </div>');
    }
}
