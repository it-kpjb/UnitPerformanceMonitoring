<aside class="sidebar-left bg-white shadow-sm" id="leftSidebar" data-simplebar style="border-right: 1px solid rgba(0,0,0,0.05); z-index: 1030;">
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    
    <nav class="vertnav navbar navbar-light px-3 py-4 d-flex flex-column h-100">
        
        <!-- Brand Logo -->
        <div class="w-100 mb-5 d-flex align-items-center justify-content-center">
            <a class="navbar-brand mt-2 flex-fill text-center d-flex align-items-center justify-content-center" href="/" style="gap: 12px; text-decoration: none;">
                <div style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); padding: 8px; border-radius: 12px; box-shadow: 0 6px 15px rgba(13,110,253,0.25);">
                    <svg version="1.1" id="logo" class="brand-sm" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                        xml:space="preserve" style="width: 24px; height: 24px; fill: white;">
                        <g>
                            <polygon points="78,105 15,105 24,87 87,87" />
                            <polygon points="96,69 33,69 42,51 105,51" />
                            <polygon points="78,33 15,33 24,15 87,15" />
                        </g>
                    </svg>
                </div>
                <span class="font-weight-bold text-dark" style="font-size: 1.3rem; letter-spacing: -0.5px;">UPM<span class="text-primary">.</span></span>
            </a>
        </div>
        
        <style>
            .sidebar-left .nav-link {
                border-radius: 0.5rem;
                transition: all 0.25s ease;
                margin-bottom: 4px;
                color: #4b5563 !important;
                font-weight: 500;
                padding: 0.6rem 1rem;
                display: flex;
                align-items: center;
            }
            .sidebar-left .nav-link:hover {
                background-color: #f3f4f6;
                color: #0d6efd !important;
                transform: translateX(4px);
            }
            .sidebar-left .nav-link:hover i {
                color: #0d6efd !important;
            }
            .sidebar-left .nav-link.active {
                background-color: rgba(13, 110, 253, 0.08);
                color: #0d6efd !important;
                font-weight: 600;
            }
            .sidebar-left .nav-link.active i {
                color: #0d6efd !important;
            }
            .sidebar-left .nav-heading {
                font-size: 0.72rem;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-weight: 700;
                color: #9ca3af !important;
            }
            .sidebar-left .collapse .nav-link {
                padding-left: 3rem !important;
                font-size: 0.9rem;
            }
            .sidebar-left .collapse .nav-link::before {
                content: '';
                position: absolute;
                left: 1.5rem;
                width: 6px;
                height: 6px;
                border-radius: 50%;
                background-color: #d1d5db;
                transition: 0.2s;
            }
            .sidebar-left .collapse .nav-link:hover::before,
            .sidebar-left .collapse .nav-link.active::before {
                background-color: #0d6efd;
            }
        </style>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a href="/home" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                    <i class="fe fe-home fe-16 text-muted"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
        </ul>
        
        @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
            <p class="nav-heading mt-4 mb-2 pl-3">
                <span>Core Modules</span>
            </p>
        @endcanany

        <ul class="navbar-nav flex-fill w-100 mb-2">
            @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
                <li class="nav-item w-100">
                    <a class="nav-link {{ request()->routeIs('docsMon.*') ? 'active' : '' }}" href="{{ route('docsMon.index') }}">
                        <i class="fe fe-file-text fe-16 text-muted"></i>
                        <span class="ml-3 item-text">DocsMon</span>
                    </a>
                </li>
            @endcanany

            @canany(['create-status', 'edit-status', 'delete-status'])
                <li class="nav-item w-100">
                    <a class="nav-link {{ request()->routeIs('status.*') ? 'active' : '' }}" href="{{ route('status.index') }}">
                        <i class="fe fe-activity fe-16 text-muted"></i>
                        <span class="ml-3 item-text">Status Master</span>
                    </a>
                </li>
            @endcanany

            @canany(['create-category', 'edit-category', 'delete-category'])
                <li class="nav-item w-100">
                    <a class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}" href="{{ route('category.index') }}">
                        <i class="fe fe-grid fe-16 text-muted"></i>
                        <span class="ml-3 item-text">Category Master</span>
                    </a>
                </li>
            @endcanany
        </ul>

        {{-- Filter by category file --}}
        @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
            <p class="nav-heading mt-4 mb-2 pl-3">
                <span>Category Search</span>
            </p>
        @endcanany

        @php
            $categories = \App\Models\Category::all();
        @endphp
        <ul class="navbar-nav flex-fill w-100 mb-3">
            @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
                @foreach ($categories as $item)
                    <li class="nav-item w-100">
                        <a class="nav-link {{ request()->is('doc-filter/'.$item->slug) ? 'active' : '' }}" href="{{ route('doc-filter', ['slug' => $item->slug]) }}">
                            <i class="fe fe-folder fe-16 text-muted"></i>
                            <span class="ml-3 item-text">{{ $item->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endcanany
        </ul>

        @canany(['create-user', 'edit-user', 'delete-user'])
            <p class="nav-heading mt-4 mb-2 pl-3">
                <span>Administration</span>
            </p>
        @endcanany

        <ul class="navbar-nav flex-fill w-100 mb-4">
            @canany(['create-user', 'edit-user', 'delete-user'])
                <li class="nav-item dropdown">
                    <a href="#user" data-toggle="collapse" aria-expanded="{{ request()->routeIs('users.*', 'roles.*', 'permissions.*') ? 'true' : 'false' }}" class="dropdown-toggle nav-link {{ request()->routeIs('users.*', 'roles.*', 'permissions.*') ? 'active' : '' }}">
                        <i class="fe fe-users fe-16 text-muted"></i>
                        <span class="ml-3 item-text">Users Management</span>
                    </a>
                    <ul class="collapse list-unstyled w-100 {{ request()->routeIs('users.*', 'roles.*', 'permissions.*') ? 'show' : '' }}" id="user">
                        <li class="nav-item">
                            <a class="nav-link position-relative {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                <span class="ml-1">User List</span>
                            </a>
                        </li>
                    @endcanany
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <li class="nav-item">
                             <a class="nav-link position-relative {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                <span class="ml-1">Roles</span>
                            </a>
                        </li>
                    @endcanany
                    @canany(['create-permission', 'edit-permission', 'delete-permission'])
                        <li class="nav-item">
                            <a class="nav-link position-relative {{ request()->routeIs('permissions.*') ? 'active' : '' }}" href="{{ route('permissions.index') }}">
                                <span class="ml-1">Permissions</span>
                            </a>
                        </li>
                    @endcanany
                    </ul>
                </li>
        </ul>
        
        <!-- Bottom Mini Profile / System Status Badge -->
        <div class="mt-auto w-100 pt-3">
            <div class="p-3 mx-2 rounded-lg" style="background: rgba(13, 110, 253, 0.05); border: 1px solid rgba(13, 110, 253, 0.1);">
                <div class="d-flex align-items-center mb-0">
                    <div class="mr-3">
                        <div class="rounded bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="fe fe-shield fe-16 text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-0 text-dark" style="font-size: 0.8rem; font-weight: 700;">System Secure</h6>
                        <span class="text-muted" style="font-size: 0.7rem;">v2.0.1 Updated</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</aside>
