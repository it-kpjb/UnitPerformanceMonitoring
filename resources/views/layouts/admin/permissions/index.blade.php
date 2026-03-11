@extends('layouts.admin.app')

@section('content')

    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Manage Permissions</h2>
            <p class="text-muted mb-0">View, create, and manage granular system permissions</p>
        </div>
        <div class="col-auto">
            @can('create-permission')
            <a href="{{ route('permissions.create') }}" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500;">
                <i class="fe fe-plus mr-1"></i> Add New Permission
            </a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0" style="border-radius: 0.75rem; overflow: hidden;">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 font-weight-bold text-dark" style="font-size: 1.1rem;">Permissions List</h5>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover mb-0 text-nowrap">
                        <thead class="bg-light" style="border-bottom: 2px solid #e5e7eb;">
                            <tr>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem; width: 5%;">#</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0" style="font-size: 0.75rem; padding: 1rem;">Name</th>
                                <th class="text-muted font-weight-bold text-uppercase border-top-0 text-right" style="font-size: 0.75rem; padding: 1rem; width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody style="border-top: none;">
                            @forelse ($permissions as $permission)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td class="align-middle text-muted" style="padding: 1rem;">{{ $loop->iteration + (method_exists($permissions, 'currentPage') ? ($permissions->currentPage() - 1) * $permissions->perPage() : 0) }}</td>
                                    <td class="align-middle" style="padding: 1rem;">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm mr-3 bg-success text-white d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 32px; height: 32px; font-size: 0.8rem; font-weight: bold;">
                                                <i class="fe fe-key"></i>
                                            </div>
                                            <span class="font-weight-bold text-dark">{{ $permission->name }}</span>
                                        </div>
                                    </td>
                                    <td class="align-middle text-right" style="padding: 1rem;">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border bg-white rounded-circle p-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 32px; height: 32px; border-color: #e5e7eb;">
                                                <i class="fe fe-more-vertical text-muted"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right shadow-sm border-0" style="border-radius: 0.5rem;">
                                                <a class="dropdown-item text-secondary py-2" href="{{ route('permissions.show', $permission->id) }}">
                                                    <i class="fe fe-eye mr-2"></i> Show
                                                </a>
                                                
                                                @can('edit-permission')
                                                    <a class="dropdown-item text-secondary py-2" href="{{ route('permissions.edit', $permission->id) }}">
                                                        <i class="fe fe-edit-2 mr-2"></i> Edit
                                                    </a>   
                                                @endcan
                
                                                @can('delete-permission')
                                                    <div class="dropdown-divider my-1"></div>
                                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item text-danger py-2" type="submit" onclick="return confirm('Do you want to delete this permission?');">
                                                            <i class="fe fe-trash-2 mr-2"></i> Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">
                                        <div class="mb-3"><i class="fe fe-key fe-32 text-light"></i></div>
                                        <p class="mb-0">No permissions found in the database.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if(method_exists($permissions, 'links'))
                <div class="card-footer bg-white border-top-0 py-3 p-4" style="border-top: 1px solid #f3f4f6 !important;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <p class="text-muted mb-0" style="font-size: 0.85rem;">
                            Showing <span class="font-weight-bold text-dark">{{ $permissions->firstItem() ?? 0 }}</span> to <span class="font-weight-bold text-dark">{{ $permissions->lastItem() ?? 0 }}</span> of <span class="font-weight-bold text-dark">{{ $permissions->total() }}</span> permissions
                        </p>
                        <div class="mt-2 mt-md-0">
                            {{ $permissions->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
