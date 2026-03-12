<nav class="topnav navbar navbar-light bg-white px-4 shadow-sm" style="border-bottom: 1px solid rgba(0,0,0,0.05); z-index: 1020; min-height: 70px;">
    <button type="button" class="navbar-toggler text-muted p-0 mr-3 collapseSidebar" style="border: none; background: transparent; transition: 0.2s;">
        <i class="fe fe-menu navbar-toggler-icon" style="color: #6c757d;"></i>
    </button>
    
    <ul class="nav ml-auto d-flex align-items-center">
        <!-- Theme Switcher -->
        <li class="nav-item">
            <a class="nav-link text-muted my-2 p-2 rounded-circle hover-bg-light" href="#" id="modeSwitcher" data-mode="light" style="transition: all 0.2s;">
                <i class="fe fe-sun fe-16 text-warning"></i>
            </a>
        </li>
        
        <!-- User Profile Dropdown -->
        <li class="nav-item dropdown ml-3">
            <a class="nav-link dropdown-toggle text-muted pr-0 d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="gap: 12px; cursor: pointer;">
                <div class="d-none d-md-flex flex-column text-right mr-1">
                    <span class="text-dark font-weight-bold" style="font-size: 0.85rem; line-height: 1.2;">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    <span class="text-muted" style="font-size: 0.75rem;">Admin</span>
                </div>
                <span class="avatar avatar-sm">
                    <img src="{{ asset('assets/avatars/face-1.jpg') }}" alt="User Avatar" class="avatar-img rounded-circle border border-2 border-white shadow-sm" style="width: 38px; height: 38px; object-fit: cover;">
                </span>
            </a>
            
            <!-- Dropdown Menu -->
            <div class="dropdown-menu dropdown-menu-right shadow border-0" aria-labelledby="navbarDropdownMenuLink" style="border-radius: 0.75rem; overflow: hidden; min-width: 220px; top: 120%;">
                <div class="px-4 py-3 bg-light border-bottom">
                    <p class="mb-0 text-dark font-weight-bold text-truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                    <small class="text-muted text-truncate d-block">{{ Auth::user()->email ?? 'admin@example.com' }}</small>
                </div>
                <a class="dropdown-item py-2 mt-1 d-flex align-items-center text-secondary" href="#">
                    <i class="fe fe-user mr-3"></i> My Profile
                </a>         
                <a class="dropdown-item py-2 d-flex align-items-center text-secondary" href="#">
                    <i class="fe fe-settings mr-3"></i> Account Settings
                </a>         
                <div class="dropdown-divider my-1"></div>
                <a href="{{ route('auth.logout') }}" class="dropdown-item py-2 text-danger d-flex align-items-center mb-1">
                    <i class="fe fe-log-out mr-3"></i> Sign Out
                </a>
            </div>
        </li>
    </ul>
    
    <style>
        .hover-bg-light:hover {
            background-color: #f8f9fa !important;
        }
        .dropdown-item:hover {
            background-color: #f3f4f6;
            color: #0d6efd !important;
        }
        .dropdown-item i {
            transition: 0.2s;
        }
        .dropdown-item:hover i {
            color: #0d6efd !important;
        }
    </style>
</nav>