<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="/">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item">
                <a href="/home" class=" nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
        @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Unit Performance Monitoring</span>
            </p>
        @endcanany

        <ul class="navbar-nav flex-fill w-100 mb-2">
            @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('docsMon.index') }}">
                        <i class="fe fe-file fe-16"></i>
                        <span class="ml-3 item-text">DocsMon</span>
                    </a>
                </li>
            @endcanany

            @canany(['create-status', 'edit-status', 'delete-status'])
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('status.index') }}">
                        <i class="fe fe-tag fe-16"></i>
                        <span class="ml-3 item-text">Status</span>
                    </a>
                </li>
            @endcanany

            @canany(['create-category', 'edit-category', 'delete-category'])
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ route('category.index') }}">
                        <i class="fe fe-tag fe-16"></i>
                        <span class="ml-3 item-text">Category</span>
                    </a>
                </li>
            @endcanany

        </ul>

        {{-- Filter by category file --}}
        @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Category Documents</span>
            </p>
        @endcanany

        @php
            $categories = \App\Models\Category::all();
        @endphp
        <ul class="navbar-nav flex-fill w-100 mb-2">
            @canany(['create-docsMon', 'edit-docsMon', 'delete-docsMon'])
                @foreach ($categories as $item)
                    <li class="nav-item w-100">
                        <a class="nav-link" href="{{ route('doc-filter', ['slug' => $item->slug]) }}">
                            <i class="fe fe-file fe-16"></i>
                            <span class="ml-3 item-text">{{ $item->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endcanany
        </ul>


        @canany(['create-user', 'edit-user', 'delete-user'])
            <p class="text-muted nav-heading mt-4 mb-1">
                <span>Users Management</span>
            </p>
        @endcanany

        <ul class="navbar-nav flex-fill w-100 mb-2">

            @canany(['create-user', 'edit-user', 'delete-user'])
                <li class="nav-item dropdown">
                    <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-users fe-16"></i>
                        <span class="ml-3 item-text">Users</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="user">
                        <a class="nav-link pl-3" href="{{ route('users.index') }}"><span class="ml-1">User
                                List</span></a>
                    @endcanany
                    @canany(['create-role', 'edit-role', 'delete-role'])
                        <a class="nav-link pl-3" href="{{ route('roles.index') }}"><span class="ml-1">Roles</span></a>
                    @endcanany
                    @canany(['create-permission', 'edit-permission', 'delete-permission'])
                        <a class="nav-link pl-3" href="{{ route('permissions.index') }}"><span
                                class="ml-1">Permissions</span></a>
                    @endcanany
                </ul>
            </li>

            <!-- <li class="nav-item dropdown">
              <a href="#contact" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-book fe-16"></i>
                <span class="ml-3 item-text">Contacts</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="contact">
                <a class="nav-link pl-3" href="./contacts-list.html"><span class="ml-1">Contact List</span></a>
                <a class="nav-link pl-3" href="./contacts-grid.html"><span class="ml-1">Contact Grid</span></a>
                <a class="nav-link pl-3" href="./contacts-new.html"><span class="ml-1">New Contact</span></a>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#profile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Profile</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="profile">
                <a class="nav-link pl-3" href="./profile.html"><span class="ml-1">Overview</span></a>
                <a class="nav-link pl-3" href="./profile-settings.html"><span class="ml-1">Settings</span></a>
                <a class="nav-link pl-3" href="./profile-security.html"><span class="ml-1">Security</span></a>
                <a class="nav-link pl-3" href="./profile-notification.html"><span class="ml-1">Notifications</span></a>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#fileman" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-folder fe-16"></i>
                <span class="ml-3 item-text">File Manager</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="fileman">
                <a class="nav-link pl-3" href="./files-list.html"><span class="ml-1">Files List</span></a>
                <a class="nav-link pl-3" href="./files-grid.html"><span class="ml-1">Files Grid</span></a>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#support" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-compass fe-16"></i>
                <span class="ml-3 item-text">Help Desk</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="support">
                <a class="nav-link pl-3" href="./support-center.html"><span class="ml-1">Home</span></a>
                <a class="nav-link pl-3" href="./support-tickets.html"><span class="ml-1">Tickets</span></a>
                <a class="nav-link pl-3" href="./support-ticket-detail.html"><span class="ml-1">Ticket Detail</span></a>
                <a class="nav-link pl-3" href="./support-faqs.html"><span class="ml-1">FAQs</span></a>
              </ul>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Extra</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-file fe-16"></i>
                <span class="ml-3 item-text">Pages</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100 w-100" id="pages">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./page-orders.html">
                    <span class="ml-1 item-text">Orders</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./page-timeline.html">
                    <span class="ml-1 item-text">Timeline</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./page-invoice.html">
                    <span class="ml-1 item-text">Invoice</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./page-404.html">
                    <span class="ml-1 item-text">Page 404</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./page-500.html">
                    <span class="ml-1 item-text">Page 500</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./page-blank.html">
                    <span class="ml-1 item-text">Blank</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#auth" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-shield fe-16"></i>
                <span class="ml-3 item-text">Authentication</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="auth">
                <a class="nav-link pl-3" href="./auth-login.html"><span class="ml-1">Login 1</span></a>
                <a class="nav-link pl-3" href="./auth-login-half.html"><span class="ml-1">Login 2</span></a>
                <a class="nav-link pl-3" href="./auth-register.html"><span class="ml-1">Register</span></a>
                <a class="nav-link pl-3" href="./auth-resetpw.html"><span class="ml-1">Reset Password</span></a>
                <a class="nav-link pl-3" href="./auth-confirm.html"><span class="ml-1">Confirm Password</span></a>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a href="#layouts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-layout fe-16"></i>
                <span class="ml-3 item-text">Layout</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="layouts">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./index.html"><span class="ml-1 item-text">Default</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./index-horizontal.html"><span class="ml-1 item-text">Top Navigation</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./index-boxed.html"><span class="ml-1 item-text">Boxed</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Documentation</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../docs/index.html">
                <i class="fe fe-help-circle fe-16"></i>
                <span class="ml-3 item-text">Getting Start</span>
              </a>
            </li>
          </ul>
          <div class="btn-box w-100 mt-4 mb-1">
            <a href="https://themeforest.net/item/tinydash-bootstrap-html-admin-dashboard-template/27511269" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
              <i class="fe fe-shopping-cart fe-12 mx-2"></i><span class="small">Buy now</span>
            </a>
          </div> -->
    </nav>
</aside>
