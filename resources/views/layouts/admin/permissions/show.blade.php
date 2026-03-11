@extends('layouts.admin.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Permission Details</h2>
            <p class="text-muted mb-0">View complete information for this permission</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('permissions.index') }}" class="btn btn-light px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; border: 1px solid #e5e7eb;">
                <i class="fe fe-arrow-left mr-1"></i> Back to Permissions
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="card-title mb-0 font-weight-bold text-dark">Permission Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4 pb-4 border-bottom" style="border-color: #f3f4f6 !important;">
                        <div class="avatar avatar-xl mr-4 bg-success text-white d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 72px; height: 72px; font-size: 1.75rem; font-weight: bold;">
                            <i class="fe fe-key"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 font-weight-bold text-dark">{{ $permission->name }}</h4>
                            <p class="text-muted mb-0 d-flex align-items-center">System Permission</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted font-weight-bold" style="font-size: 0.85rem; text-transform: uppercase;">
                            Permission ID
                        </div>
                        <div class="col-sm-8 text-dark font-weight-medium">
                            <span class="badge badge-pill badge-light text-secondary border px-2 py-1" style="font-weight: 500;">{{ $permission->id }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted font-weight-bold" style="font-size: 0.85rem; text-transform: uppercase;">
                            Name
                        </div>
                        <div class="col-sm-8 text-dark font-weight-medium">
                            {{ $permission->name }}
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-top-0 py-3 px-4 d-flex justify-content-end" style="border-radius: 0 0 0.75rem 0.75rem;">
                    @can('edit-permission')
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500;">
                            <i class="fe fe-edit-2 mr-1"></i> Edit Permission
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>    
@endsection