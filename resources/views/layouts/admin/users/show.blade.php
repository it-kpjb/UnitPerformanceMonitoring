@extends('layouts.admin.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">User Details</h2>
            <p class="text-muted mb-0">View complete information for this user</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('users.index') }}" class="btn btn-light px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; border: 1px solid #e5e7eb;">
                <i class="fe fe-arrow-left mr-1"></i> Back to Users
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="card-title mb-0 font-weight-bold text-dark">User Information</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4 pb-4 border-bottom" style="border-color: #f3f4f6 !important;">
                        <div class="avatar avatar-xl mr-4 bg-primary text-white d-flex align-items-center justify-content-center rounded-circle shadow-sm" style="width: 72px; height: 72px; font-size: 1.75rem; font-weight: bold;">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="mb-1 font-weight-bold text-dark">{{ $user->name }}</h4>
                            <p class="text-muted mb-0 d-flex align-items-center"><i class="fe fe-mail mr-2"></i> {{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted font-weight-bold" style="font-size: 0.85rem; text-transform: uppercase;">
                            Name
                        </div>
                        <div class="col-sm-8 text-dark font-weight-medium">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-4 text-muted font-weight-bold" style="font-size: 0.85rem; text-transform: uppercase;">
                            Email Address
                        </div>
                        <div class="col-sm-8 text-dark font-weight-medium">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted font-weight-bold" style="font-size: 0.85rem; text-transform: uppercase;">
                            Assigned Roles
                        </div>
                        <div class="col-sm-8">
                            @forelse ($user->getRoleNames() as $role)
                                <span class="badge badge-pill badge-primary-light text-primary px-3 py-1 mr-1 mb-1" style="background-color: #dbeafe; font-weight: 500; font-size: 0.85rem;">
                                    <i class="fe fe-shield mr-1"></i> {{ $role }}
                                </span>
                            @empty
                                <span class="text-muted font-italic">No roles assigned</span>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-top-0 py-3 px-4 d-flex justify-content-end" style="border-radius: 0 0 0.75rem 0.75rem;">
                    @can('edit-user')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500;">
                            <i class="fe fe-edit-2 mr-1"></i> Edit User
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>    
@endsection