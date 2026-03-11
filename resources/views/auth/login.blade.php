@extends('layouts.app')

@section('content')
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Premium Login Styles */
    .login-container {
        font-family: 'Inter', sans-serif;
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        padding: 2rem 1rem;
        margin-top: -2rem; /* Offset for app layout padding */
    }
    
    .login-card {
        background: #ffffff;
        border: none;
        border-radius: 1.25rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0,0,0,0.05);
        width: 100%;
        max-width: 440px;
        overflow: hidden;
        position: relative;
    }
    
    .login-header {
        text-align: center;
        padding: 2.5rem 2.5rem 1rem;
    }
    
    .login-logo {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.25);
        padding: 12px;
    }
    
    .login-logo svg {
        fill: #ffffff;
        width: 100%;
        height: 100%;
    }
    
    .login-body {
        padding: 1rem 2.5rem 3rem;
    }
    
    .form-control-custom {
        padding: 0.875rem 1.25rem;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        background-color: #f9fafb;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        color: #374151;
    }
    
    .form-control-custom:focus {
        background-color: #ffffff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    /* When invalid but want to keep modern styling */
    .form-control-custom.is-invalid {
        border-color: #dc3545;
        background-image: none; /* Remove default bootstrap icon if desired, or keep it */
    }
    
    .btn-login {
        padding: 0.875rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.3px;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 8px 15px rgba(13, 110, 253, 0.2);
        transition: all 0.3s ease;
    }
    
    .btn-login:hover, .btn-login:focus {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(13, 110, 253, 0.25);
        background: linear-gradient(135deg, #0b5ed7 0%, #0947a5 100%);
        color: white;
    }
    
    .form-label-custom {
        font-weight: 500;
        color: #4b5563;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .custom-checkbox .form-check-input {
        border-radius: 0.3rem;
        cursor: pointer;
        margin-top: 0.25rem;
    }
    
    .custom-checkbox .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .custom-checkbox .form-check-label {
        color: #6b7280;
        font-size: 0.9rem;
        cursor: pointer;
        font-weight: 400;
    }
    
    .forgot-password-link {
        color: #0d6efd;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }
    
    .forgot-password-link:hover {
        color: #0a58ca;
        text-decoration: underline;
    }
    
    .login-footer {
        text-align: center;
        margin-top: 2rem;
        font-size: 0.85rem;
        color: #9ca3af;
    }
    
    .alert-custom {
        border-radius: 0.75rem;
        border: none;
        background-color: #fef2f2;
        color: #dc2626;
        border-left: 4px solid #dc2626;
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        box-shadow: 0 4px 6px rgba(220, 38, 38, 0.05);
    }
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                  <g>
                    <polygon points="78,105 15,105 24,87 87,87" />
                    <polygon points="96,69 33,69 42,51 105,51" />
                    <polygon points="78,33 15,33 24,15 87,15" />
                  </g>
                </svg>
            </div>
            <h3 class="fw-bold text-dark mb-1">Welcome Back</h3>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Please sign in to your account</p>
        </div>
        
        <div class="login-body">
            <!-- Modern Error Notification -->
            @if(session('error') || $errors->any())
                <div class="alert alert-custom alert-dismissible fade show mb-4" role="alert">
                    <div class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-3 flex-shrink-0 mt-1" style="color: #dc2626;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <div>
                            <strong class="d-block mb-1" style="color: #991b1b;">Authentication Failed</strong>
                            <div style="color: #b91c1c;">
                                @if(session('error'))
                                    {{ session('error') }}
                                @else
                                    {{ $errors->first() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" style="font-size: 0.8rem; padding: 1.25rem;" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label-custom">Email Address</label>
                    <input type="email" id="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus autocomplete="email">
                </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label-custom mb-0">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot password?</a>
                        @endif
                    </div>
                    <input type="password" id="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" placeholder="Enter your password" required autocomplete="current-password">
                </div>
                
                <div class="mb-4 custom-checkbox form-check">
                    <input type="checkbox" class="form-check-input shadow-sm" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label user-select-none" for="remember">
                        {{ __('Remember me for 30 days') }}
                    </label>
                </div>
                
                <button type="submit" class="btn btn-login btn-primary w-100 text-white mt-2">
                    Sign In
                </button>
                
                <div class="login-footer">
                    <p class="mb-0">Protected by <a href="https://nexgen.id" class="text-decoration-none fw-medium" style="color: #6b7280;">Nexgen</a> &copy; {{ date('Y') }}</p>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
