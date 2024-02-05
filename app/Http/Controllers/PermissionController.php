<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-permission|edit-permission|delete-permission', ['only' => ['index','show']]);
        $this->middleware('permission:create-permission', ['only' => ['create','store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }
    
    /**
     * Menampilkan daftar permission.
     */
    public function index(): View
    {
        $permissions = Permission::paginate(10);
        return view('layouts.admin.permissions.index', compact('permissions'));
    }

    /**
     * Menampilkan form untuk membuat permission baru.
     */
    public function create(): View
    {
        return view('layouts.admin.permissions.create');
    }

    /**
     * Menyimpan permission baru ke dalam database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|max:255',
            'guard_name' => 'nullable', // Ubah menjadi nullable agar tidak perlu diset ke 'null'
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('permissions.create')
                        ->withErrors($validator)
                        ->withInput();
        }
    
        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name ?? 'web', // Set default ke 'web' jika tidak ada nilai yang diberikan
        ]);
    
        return redirect()->route('permissions.index')
                        ->with('success', 'Permission created successfully');
    }

    /**
     * Menampilkan detail permission.
     */
    public function show(Permission $permission): View
    {
        return view('layouts.admin.permissions.show', compact('permission'));
    }

    /**
     * Menampilkan form untuk mengedit permission.
     */
    public function edit(Permission $permission): View
    {
        return view('layouts.admin.permissions.edit', compact('permission'));
    }

    /**
     * Mengupdate permission di dalam database.
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
        ]);

        if ($validator->fails()) {
            return redirect()->route('permissions.edit', $permission->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index')
                        ->with('success', 'Permission updated successfully');
    }

    /**
     * Menghapus permission dari database.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()->route('permissions.index')
                        ->with('success', 'Permission deleted successfully');
    }
}
