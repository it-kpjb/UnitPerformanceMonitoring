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
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="vertical light">
    <div class="wrapper">
        <div class="main-wrapper">

            <div class="bg-body-tertiary py-5">
                <div class="bg-body-tertiary text-center ">
                    <h3 class="" href="#">Unit Perfomence Monitoring</h3>
                </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link text-black" href="/">All</a>
                                </li>
                                @foreach ($category as $item)
                                    <li class="nav-item">
                                        <a class="nav-link text-black" href="{{ route('public.showFilter', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <span class="navbar-text">
                                <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                                    <!-- <i class="fe fe-menu navbar-toggler-icon"></i> -->
                                </button>

                                <ul class="nav">


                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ url('/docsMon') }}" class="nav-item">Home</a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                                        @endauth
                                    @endif
                                    </li>
                                </ul>
                            </span>
                        </div>
                    </div>
                </nav>

            </div>

            <main role="main">
                <div class="row justify-content-center">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 my-4">
                                <!-- <p class="mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. At est delectus minus tempore quidem, natus earum suscipit autem magnam esse et blanditiis id, fuga molestiae voluptas quae eaque. Odio, corrupti.</p> -->
                                <div class="card shadow">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <form class="form-inline">
                                                <div class="form-row">
                                                    <div class="mb-2">
                                                        <form action="{{ route('public.index') }}" method="GET">
                                                            <input type="text" class="form-control" name="search"
                                                                placeholder="Search...">
                                                            <button type="submit"
                                                                class="btn btn-sm  btn-outline-primary"><span
                                                                    class="fe fe-search fe-16 mr-2"></span>Search</button>
                                                        </form>
                                                    </div>


                                                </div>
                                            </form>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr role="row">
                                                        <th>#</th>
                                                        <th>DM Number</th>
                                                        <th>Subject</th>
                                                        <th>User</th>
                                                        <th>Category</th>
                                                        <th>Date</th>
                                                        <th>Status Doc</th>
                                                        <th>Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($docs as $doc)
                                                        @if ($doc->status->public_view == 1)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $doc->dm_number }}</td>
                                                                <td>{{ $doc->subject }}</td>
                                                                <td>{{ $doc->user }}</td>
                                                                <td>{{ $doc->category->name }}</td>
                                                                <td>{{ $doc->tgldoc }}</td>
                                                                <td><span
                                                                        class="badge badge-success">{{ $doc->status->name }}</span>
                                                                </td>
                                                                <td>
                                                                    @foreach ($doc->files as $file)
                                                                        <a href="{{ asset('storage/attachments/' . $file->attachment_path) }}"
                                                                            target="_blank">Unduh File</a>
                                                                        <br>
                                                                        <small>Last Updated:
                                                                            {{ \Carbon\Carbon::parse($file->updated_at)->diffForHumans() }}</small>
                                                                        <br>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        {{ $docs->links() }}
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
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
    <footer class="footer">
        <div class="container-fluid">
            <p class="text-muted mb-0">Copyright &copy; 2024 <a href="https://nex-gen.id">Nexgen</a></p>
        </div>
    </footer>
</body>
</html>
