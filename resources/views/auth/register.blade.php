@extends('layouts.app')

@section('content')
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    .register-container {
        font-family: 'Inter', sans-serif;
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: transparent;
        padding: 2rem 1rem;
        margin-top: -2rem;
    }

    .register-card {
        background: #ffffff;
        border: none;
        border-radius: 1.25rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08), 0 1px 3px rgba(0,0,0,0.05);
        width: 100%;
        max-width: 480px;
        overflow: hidden;
        position: relative;
    }

    .register-header {
        text-align: center;
        padding: 2.5rem 2.5rem 1rem;
    }

    .register-logo {
        width: 72px;
        height: 72px;
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-radius: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 20px rgba(13, 110, 253, 0.25);
        padding: 14px;
    }

    .register-logo svg {
        fill: #ffffff;
        width: 100%;
        height: 100%;
    }

    .register-body {
        padding: 1rem 2.5rem 2.5rem;
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

    .form-control-custom.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }

    .form-label-custom {
        font-weight: 500;
        color: #4b5563;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .btn-register {
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

    .btn-register:hover, .btn-register:focus {
        transform: translateY(-2px);
        box-shadow: 0 12px 20px rgba(13, 110, 253, 0.25);
        background: linear-gradient(135deg, #0b5ed7 0%, #0947a5 100%);
        color: white;
    }

    .divider-text {
        display: flex;
        align-items: center;
        color: #9ca3af;
        font-size: 0.85rem;
        margin: 1.25rem 0;
    }

    .divider-text::before,
    .divider-text::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    .divider-text span {
        padding: 0 0.75rem;
    }

    .btn-google {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.625rem;
        padding: 0.8rem 1.5rem;
        border-radius: 0.75rem;
        border: 1.5px solid #e5e7eb;
        background: #ffffff;
        color: #374151;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.25s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        text-decoration: none;
    }

    .btn-google:hover {
        background: #f9fafb;
        border-color: #9ca3af;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        color: #1f2937;
        transform: translateY(-1px);
        text-decoration: none;
    }

    .register-footer {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .register-footer a {
        color: #0d6efd;
        font-weight: 500;
        text-decoration: none;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }

    .alert-custom {
        border-radius: 0.75rem;
        border: none;
        background-color: #fef2f2;
        color: #dc2626;
        border-left: 4px solid #dc2626;
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <div class="register-logo">
                <svg version="1.1" id="logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                  <g>
                    <polygon points="78,105 15,105 24,87 87,87" />
                    <polygon points="96,69 33,69 42,51 105,51" />
                    <polygon points="78,33 15,33 24,15 87,15" />
                  </g>
                </svg>
            </div>
            <h3 class="fw-bold text-dark mb-1">Create Account</h3>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Join us to start managing your documents</p>
        </div>

        <div class="register-body">
            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-custom mb-4" role="alert">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Google SSO Button --}}
            <a href="{{ route('auth.google') }}" class="btn-google w-100 mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    <path fill="none" d="M0 0h48v48H0z"/>
                </svg>
                Continue with Google
            </a>

            <div class="divider-text"><span>or register with email</span></div>

            {{-- Registration Form --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label-custom">Full Name</label>
                    <input id="name" type="text"
                        class="form-control form-control-custom @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="Enter your full name">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label-custom">Email Address</label>
                    <input id="email" type="email"
                        class="form-control form-control-custom @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="Enter your email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label-custom">Password</label>
                    <input id="password" type="password"
                        class="form-control form-control-custom @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password"
                        placeholder="Minimum 8 characters">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="form-label-custom">Confirm Password</label>
                    <input id="password-confirm" type="password"
                        class="form-control form-control-custom"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Re-enter your password">
                </div>

                <button type="submit" class="btn btn-register btn-primary w-100 text-white">
                    Create Account
                </button>
            </form>

            <div class="register-footer">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@endsection
