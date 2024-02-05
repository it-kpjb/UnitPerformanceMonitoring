@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Permission Details') }}</div>

                <div class="card-body">
                    <p><strong>ID:</strong> {{ $permission->id }}</p>
                    <p><strong>Name:</strong> {{ $permission->name }}</p>
                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection