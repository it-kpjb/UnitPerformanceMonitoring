@extends('layouts.admin.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="h3 mb-0 text-gray-800 font-weight-bold">Add New User</h2>
            <p class="text-muted mb-0">Create a new system user and assign roles</p>
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
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="Enter full name">
                            @if ($errors->has('name'))
                                <span class="text-danger small mt-1 d-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label for="email" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="name@example.com">
                            @if ($errors->has('email'))
                                <span class="text-danger small mt-1 d-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-4">
                                <label for="password" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="Minimal 8 characters">
                                @if ($errors->has('password'))
                                    <span class="text-danger small mt-1 d-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <label for="password_confirmation" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; padding: 0.5rem 1rem;" placeholder="Confirm your password">
                            </div>
                        </div>

                        <div class="form-group mb-5">
                            <label for="roles" class="font-weight-bold text-secondary" style="font-size: 0.85rem;">Roles <span class="text-danger">*</span></label>
                            <select class="form-control custom-select @error('roles') is-invalid @enderror" multiple id="roles" name="roles[]" style="border-radius: 0.5rem; border: 1px solid #e5e7eb; min-height: 120px;">
                                @forelse ($roles as $role)
                                    @if ($role != 'Super Admin')
                                        <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @else
                                        @if (Auth::user()->hasRole('Super Admin'))   
                                            <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endif
                                    @endif
                                @empty
                                    <option disabled>No roles available</option>
                                @endforelse
                            </select>
                            <small class="text-muted mt-2 d-block"><i class="fe fe-info mr-1"></i> Hold <kbd>Ctrl</kbd> or <kbd>Cmd</kbd> to select multiple roles.</small>
                            @if ($errors->has('roles'))
                                <span class="text-danger small mt-1 d-block">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>
                        
                        <hr class="my-4" style="border-color: #f3f4f6;">

                        <div class="d-flex justify-content-end align-items-center" style="gap: 12px;">
                            <a href="{{ route('users.index') }}" class="btn btn-light px-4" style="border-radius: 0.5rem; color: #4b5563; font-weight: 500; border: 1px solid #e5e7eb; transition: 0.2s;">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 0.5rem; font-weight: 500; transition: 0.2s;">
                                Add User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
@endsection