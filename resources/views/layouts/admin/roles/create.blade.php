@extends('layouts.admin.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Add New Role</h2>
            <p class="text-muted mb-0">Create a new system role and assign permissions</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('roles.index') }}" class="btn btn-light px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; border: 1px solid #e5e7eb;">
                <i class="fe fe-arrow-left mr-1"></i> Back to Roles
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 0.75rem;">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="card-title mb-0 font-weight-bold text-dark">Role Information</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="e.g. Content Manager">
                            @if ($errors->has('name'))
                                <span class="text-danger small mt-1 d-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-5">
                            <label for="permissions" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Permissions <span class="text-danger">*</span></label>
                            <select class="form-control custom-select @error('permissions') is-invalid @enderror" multiple id="permissions" name="permissions[]" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; min-height: 200px;">
                                @forelse ($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions') ?? []) ? 'selected' : '' }}>
                                        {{ $permission->name }}
                                    </option>
                                @empty
                                    <option disabled>No permissions available</option>
                                @endforelse
                            </select>
                            <small class="text-muted mt-2 d-block"><i class="fe fe-info mr-1"></i> Hold <kbd>Ctrl</kbd> or <kbd>Cmd</kbd> to select multiple permissions.</small>
                            @if ($errors->has('permissions'))
                                <span class="text-danger small mt-1 d-block">{{ $errors->first('permissions') }}</span>
                            @endif
                        </div>
                        
                        <hr class="my-4" style="border-color: #f3f4f6;">

                        <div class="d-flex justify-content-end align-items-center" style="gap: 12px;">
                            <a href="{{ route('roles.index') }}" class="btn btn-light px-4" style="border-radius: 0.5rem; color: #4b5563; font-weight: 500; border: 1px solid #e5e7eb; transition: 0.2s;">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; transition: 0.2s;">
                                Add Role
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection