<header class="header ">
    <div class="logo">
        <a href="{{ route('home') }}"> <img src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
                alt="Logo" class="logo-img">
        </a>
    </div>
    <div class="search-container  " style="position: relative; display:flex;">
        <livewire:search-component />
    </div>
    <nav class="nav">
        <a href="{{ route('home') }}" class="nav-link">Home</a>

        <a href="{{ route('myBlogs.create') }}" class="nav-link">Write</a>

        <div class="dropdown">
            <button class="dropbtn">My Categories<span class="arrow">▼</span></button>
            <div class="dropdown-content">
                @if (isset($user_categories))
                    @foreach ($user_categories as $category)
                        <a href="{{ route('show.blogs', $category->id) }}">
                            {{ $category->name }}({{ \App\Models\Blog::where('category_id', $category->id)->where('status', 1)->count() }})
                        </a>
                    @endforeach
                    <hr class="custom-hr">
                    <a style="background-color: #e4e4e4" href="{{ route('add_more_categories') }}">All Categories</a>
                @endif
            </div>
        </div>
        <div class="dropdown">

            <button class="dropbtn" id="dropBTN">
                <div id="notification-bell" class="nav-link justify-content-center" style="display: flex">
                    <svg style="width: 25px; height:25px" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                    </svg>
                    <div class="notification-icon-header bg-success text-white">{{ $notifications_count }}
                    </div>
                </div>
            </button>
            <div id="notificationDropdown" class="dropdown-content">
                @if ($notifications->count() > 0)
                    @foreach ($notifications as $notification)
                        <a class="notification-item "
                            href="{{ route('notification_read_redirect', $notification->id) }}">
                            @if (!isset($notification->read_at))
                                <div class="notification-icon bg-info text-white">*</div>
                            @endif
                            <div>
                                <p class="notification-title">{{ $notification->title }}</p>
                                <p class="notification-description">
                                    {{ $notification->sender_name($notification) }},{{ $notification->content }}
                                </p>
                                <p class="notification-time">
                                    {{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </a>
                    @endforeach
                    <div class="p-2 text-center">
                        <a id="all-notis" href="{{ route('show_notifications') }}" class="text-decoration-none"> All
                            Notifications</a>
                    </div>
                @else
                    Box is empty...
                @endif
            </div>
        </div>

        <div class="dropdown" id="profile-dropdown">
            <button class="dropbtn">{{ Auth::user()->name }}<span class="arrow">▼</span></button>
            <div class="dropdown-content" style=" left:-50px ;">
                <a href="{{ route('profile.show') }}">Profile</a>
                <a href="{{ route('saved_blogs') }}">Saved Blogs</a>
                <a href="{{ route('profile.edit') }}">Edit-Delete Profile</a>
                <hr class="custom-hr">
                <a class=" sign-out" href="# ">Sign Out</a>
            </div>
        </div>
    </nav>
    <button class="menu-toggle">☰</button>
</header>
