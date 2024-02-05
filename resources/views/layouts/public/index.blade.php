<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('css/simplebar.css') }}">
    
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/uppy.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('css/app-dark.css') }}" id="darkTheme" disabled>
</head>

<body class="vertical light">
    <div class="wrapper">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            
            <nav class="topnav navbar navbar-light">
                <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                    <!-- <i class="fe fe-menu navbar-toggler-icon"></i> -->
                </button>
                
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                            <i class="fe fe-sun fe-16"></i>
                        </a>
                    </li>
                    
                    <li class="nav-item nav-notif">
                        @if (Route::has('login'))
                            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                                @auth
                                    <a href="{{ url('/docsMon') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </li>
                </ul>
            </nav>

            <main role="main">
                <div class="row justify-content-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 my-4">
                                <h2 class="h4 mb-1">Unit Performance Monitoring</h2>
                                <p class="mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. At est delectus minus tempore quidem, natus earum suscipit autem magnam esse et blanditiis id, fuga molestiae voluptas quae eaque. Odio, corrupti.</p>
                                <div class="card shadow">
                                    <div class="card-body">
                                    <div class="toolbar row mb-3">
                                        <div class="col">
                                                <form class="form-inline" action="{{ route('docsMon.index') }}" method="GET">
                                                    <div class="form-row mb-2">
                                                        <input type="text" class="form-control" name="search" placeholder="Search...">
                                                        <button type="submit" class="btn btn-sm btn-outline-primary"><span class="fe fe-search fe-16 mr-2"></span>Search</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>DM Number</th>
                                                    <th>Subject</th>
                                                    <th>User</th>
                                                    <th>Date</th>
                                                    <th>Status Doc</th>
                                                    <th>Document</th>
                                                </tr>
                                            </thead>
                                            <tbody>    
                                            @foreach($docs as $doc)
                                                @if ($doc->status->name == 'Uploaded')
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $doc->dm_number }}</td>
                                                    <td>{{ $doc->subject }}</td>
                                                    <td>{{ $doc->user }}</td>
                                                    <td>{{ $doc->tgldoc }}</td>
                                                    <td><span class="badge badge-success">{{ $doc->status->name }}</span></td>
                                                    <td>
                                                    @foreach($doc->files as $file)
                                                        <a href="{{ asset('storage/attachments/' . $file->attachment_path) }}" target="_blank">Unduh File</a>
                                                        <br>
                                                        <small>Last Updated: {{ \Carbon\Carbon::parse($file->updated_at)->diffForHumans() }}</small>
                                                        <br>
                                                    @endforeach
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <nav aria-label="Table Paging" class="mb-0 text-muted">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $currentPage == 1 ? '#' : route('docsMon.index', ['page' => $currentPage - 1]) }}">Previous</a>
                                                </li>
                                                @for ($i = 1; $i <= $totalPages; $i++)
                                                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                                        <a class="page-link" href="{{ route('docsMon.index', ['page' => $i]) }}">{{ $i }}</a>
                                                    </li>
                                                @endfor
                                                <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ $currentPage == $totalPages ? '#' : route('docsMon.index', ['page' => $currentPage + 1]) }}">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- General JS Scripts -->
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/popper.min.js') }}"></script>
            <script src="{{ asset('js/moment.min.js') }}"></script>
            <script src="{{ asset('js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('js/simplebar.min.js') }}"></script>
            <script src="{{ asset('js/daterangepicker.js') }}"></script>
            <script src="{{ asset('js/jquery.stickOnScroll.js') }}"></script>
            <script src="{{ asset('js/tinycolor-min.js') }}"></script>
            <script src="{{ asset('js/config.js') }}"></script>
            <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
            <script src="{{ asset('js/select2.min.js') }}"></script>
            <script src="{{ asset('js/jquery.timepicker.js') }}"></script>
            <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('js/apps.js') }}"></script>
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
            <script>
                window.dataLayer = window.dataLayer || [];

                function gtag() {
                    dataLayer.push(arguments);
                }
                gtag('js', new Date());
                gtag('config', 'UA-56159088-1');
            </script>
        </div>
    </div>
</body>

</html>
