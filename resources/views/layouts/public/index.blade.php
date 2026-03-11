<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Unit Performance Monitoring">
    <meta name="author" content="Nexgen">
    <link rel="icon" href="favicon.ico">
    <title>Unit Performance Monitoring</title>

    <!-- Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            padding: 4rem 0 5rem 0;
            position: relative;
            overflow: hidden;
            border-bottom-left-radius: 2rem;
            border-bottom-right-radius: 2rem;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.15);
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-radius: 1rem;
            padding: 0.75rem 1.5rem;
            margin-top: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .nav-link {
            font-weight: 500;
            color: #4b5563 !important;
            transition: all 0.2s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
        }

        .nav-link:hover, .nav-link.active {
            color: #0d6efd !important;
            background-color: rgba(13, 110, 253, 0.05);
        }

        /* Content Container */
        .main-container {
            margin-top: -3.5rem;
            z-index: 10;
            position: relative;
            flex: 1;
        }

        /* Card styles */
        .card-modern {
            border: none;
            border-radius: 1rem;
            background: #ffffff;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        /* Search styling */
        .search-container {
            background: white;
            padding: 1.5rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .search-input {
            border-radius: 50rem 0 0 50rem;
            padding: 0.75rem 1.5rem;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            box-shadow: none;
            transition: all 0.2s;
        }

        .search-input:focus {
            background-color: #fff;
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .btn-search {
            border-radius: 0 50rem 50rem 0;
            padding: 0.75rem 1.75rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Table styles */
        .table-modern {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table-modern th {
            border-top: none;
            border-bottom-width: 1px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #6b7280;
            padding: 1rem 1.5rem;
            background: #fdfdfd;
        }

        .table-modern td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }

        .table-modern tbody tr {
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background-color: #f9fafb;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        .badge-status {
            font-weight: 500;
            padding: 0.5em 0.8em;
            border-radius: 8px;
            letter-spacing: 0.3px;
        }
        
        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
            font-weight: 500;
            color: #0d6efd;
            background: #f0f7ff;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.85rem;
        }

        .file-link:hover {
            background: #0d6efd;
            color: #fff;
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            color: #0d6efd;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .footer {
            padding: 2rem 0;
            text-align: center;
            color: #6b7280;
            font-size: 0.9rem;
            margin-top: auto;
        }

        .pagination-container {
            padding: 1rem 1.5rem;
            background: #fdfdfd;
            border-top: 1px solid #f3f4f6;
        }
        
        .pagination {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center position-relative" style="z-index: 2;">
            <h2 class="fw-bold mb-2 text-white">Unit Performance Monitoring</h2>
            <p class="text-white-50 mt-1 mb-0 fs-5">Track, manage, and monitor your unit documents efficiently</p>
        </div>
    </div>

    <div class="container main-container">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-custom mb-4">
            <div class="container-fluid">
                <button class="navbar-toggler border-0 shadow-none text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center gap-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active fw-semibold' : '' }}" href="/">All Categories</a>
                        </li>
                        @foreach ($category as $item)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->url() == route('public.showFilter', ['slug' => $item->slug]) ? 'active fw-semibold' : '' }}" href="{{ route('public.showFilter', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex align-items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/docsMon') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm">Log in</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            <div class="card-modern">
                <!-- Search Bar -->
                <div class="search-container">
                    <form action="{{ route('public.index') }}" method="GET" class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                            <i data-feather="file-text" class="text-primary"></i> Documents
                        </h5>
                        <div class="d-flex" style="min-width: 300px; max-width: 100%;">
                            <input type="text" class="form-control search-input" name="search" placeholder="Search by DM Number, Subject..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-search shadow-sm">
                                <i data-feather="search" style="width: 18px; height: 18px;"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-modern">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="14%">DM Number</th>
                                <th>Subject</th>
                                <th width="15%">User</th>
                                <th width="12%">Category</th>
                                <th width="15%">Date</th>
                                <th width="10%">Status</th>
                                <th width="15%">Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($docs as $doc)
                                @if ($doc->status->public_view == 1)
                                    <tr>
                                        <td><span class="text-muted fw-medium">{{ $loop->iteration }}</span></td>
                                        <td><span class="fw-semibold text-dark">{{ $doc->dm_number }}</span></td>
                                        <td>
                                            <span class="fw-medium text-dark d-block">{{ $doc->subject }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($doc->user, 0, 1)) }}
                                                </div>
                                                <span class="fw-medium">{{ $doc->user }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-secondary border px-2 py-1 rounded-pill">{{ $doc->category->name ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-1 text-muted">
                                                <i data-feather="calendar" style="width: 14px; height: 14px;"></i>
                                                {{ $doc->tgldoc ? \Carbon\Carbon::parse($doc->tgldoc)->format('d M Y') : '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 badge-status">
                                                {{ $doc->status->name ?? 'Active' }}
                                            </span>
                                        </td>
                                        <td>
                                            @forelse ($doc->files as $file)
                                                <div class="mb-2">
                                                    <a href="{{ asset('storage/attachments/' . $file->attachment_path) }}" target="_blank" class="file-link">
                                                        <i data-feather="download-cloud" style="width: 14px; height: 14px;"></i> Download
                                                    </a>
                                                    <div class="text-muted mt-1" style="font-size: 0.7rem;">
                                                        Updated: {{ \Carbon\Carbon::parse($file->updated_at)->diffForHumans() }}
                                                    </div>
                                                </div>
                                            @empty
                                                <span class="text-muted small">-</span>
                                            @endforelse
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted mb-3 d-flex justify-content-center">
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                <i data-feather="inbox" style="width: 40px; height: 40px; color: #9ca3af;"></i>
                                            </div>
                                        </div>
                                        <h5 class="fw-bold text-dark">No documents found</h5>
                                        <p class="text-muted mb-0">Try adjusting your search criteria or check back later.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if(isset($docs) && $docs->hasPages())
                <div class="pagination-container d-flex justify-content-center">
                    {{ $docs->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="footer">
            <p class="mb-0">Copyright &copy; {{ date('Y') }} <a href="https://nexgen.id" class="text-decoration-none fw-medium text-primary">Nexgen</a>. All rights reserved.</p>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
    </script>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-56159088-1');
    </script>
</body>
</html>
