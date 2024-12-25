<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link  @if ($page == 'dashboard') @else collapsed @endif "
                href=" {{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->is_admin == 1)
            <li class="nav-item">
                <a class="nav-link @if ($page == 'users') @else collapsed @endif"
                    href=" {{ route('users') }}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if ($page == 'categories') @else collapsed @endif "
                    href=" {{ route('categories') }}">
                    <i class="bi bi-person"></i>
                    <span>Categories</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link @if ($page == 'blogs_comments') @else collapsed @endif "
                href=" {{ route('blogs_comments') }}">
                <i class="bi bi-person"></i>
                <span>Blogs and Comments</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if ($page == 'pending_blogs') @else collapsed @endif "
                href=" {{ route('pending_blogs') }}">
                <i class="bi bi-person"></i>
                <span>Pending Blogs
                    <span class="badge text-bg-danger">@if ($pending_blogs_count > 0)
                        {{$pending_blogs_count}}
                    @endif</span>
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if ($page == 'tags') @else collapsed @endif "
                href=" {{ route('tags_list') }}">
                <i class="bi bi-person"></i>
                <span>Tags</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if ($page == 'change_password') @else collapsed @endif "
                href=" {{ route('change_password') }}">
                <i class="bi bi-key"></i>
                <span>Change Password</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if ($page == 'site_settings') @else collapsed @endif "
                href=" {{ route('site_settings') }}">
                <i class="bi bi-key"></i>
                <span>Website Settings</span>
            </a>
        </li>



    </ul>

</aside><!-- End Sidebar-->
