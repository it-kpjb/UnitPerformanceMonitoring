<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        // $statuses = Status::all();
        $status = Status::all();

        return view('layouts.admin.status.index', compact('status'));
    }

    public function create()
    {
        return view('layouts.admin.status.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        // Menangani nilai checkbox
        $request->merge([
            'public_view' => $request->has('public_view') ? 1 : 0
        ]);

        Status::create($request->all());

        return redirect()->route('status.index')->with('success', '<div class="alert alert-primary" role="alert">
        <span class="fe fe-alert-circle fe-16 mr-2"></span> Add Successfully! </div>');
    }

    public function edit(Status $status)
    {
        return view('layouts.admin.status.edit', compact('status'));
    }

    public function update(Request $request, Status $status)
    {
        // Validasi untuk name dan desc
        $request->validate([
            'name' => 'required|string',
            'desc' => 'required|string',
        ]);

        // Menangani nilai checkbox
        $request->merge([
            'public_view' => $request->has('public_view') ? 1 : 0
        ]);

        // Update data lain seperti biasa
        $status->update($request->all());  

        return redirect()->route('status.index')->with('success', '<div class="alert alert-success" role="alert">
            <span class="fe fe-alert-octagon fe-16 mr-2"></span> Update Successfully </div>');
    }



    public function destroy(Status $status)
    {
        $status->delete();

        return redirect()->route('status.index')->with('success', '<div class="alert alert-danger" role="alert" >
        <span class="fe fe-minus-circle fe-16 mr-2"></span> Delete Successfully! </div>');
    }
}
