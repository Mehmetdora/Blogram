<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">

    @livewireStyles

    <title>{{ $site_setting->site_name }}</title>
    <link rel="icon" type="image/png"
        href="{{ asset('site_settings/site_favicon/') }}/{{ $site_setting->favicon_url }}">


    @include('Normal_Kullanıcı.blogy_Layouts.header_style')

    <style>
        .trend-blog-image {
            width: 85px;
            height: 85px;
        }

        .widget-categories {
            max-height: 350px;
            overflow-y: auto;

        }
    </style>


</head>

<body>


    <header class="header ">
        <div class="logo">
            <a href="{{ route('home') }}"> <img
                    src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}" alt="Logo"
                    class="logo-img">
            </a>
        </div>
        <div class="search-container ml-2 ">
            <livewire:search-component />
        </div>
        <nav class="nav" style="margin-left: 10px">
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
                        <a style="background-color: #e4e4e4" href="{{ route('add_more_categories') }}">All
                            Categories</a>
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
                            <a id="all-notis" href="{{ route('show_notifications') }}" class="text-decoration-none">
                                All
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

    <div class="banner text-center">



        <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z"
                stroke="#040306" stroke-miterlimit="10" />
        </svg>

        <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                    d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10" />
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979"
                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix"
                        values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>


        <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z"
                stroke="#040306" stroke-miterlimit="10" />
        </svg>


        <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>

    @include('Normal_Kullanıcı.blogy_Layouts.spinner')


    <section class="section pb-0">
        <div class="container col-lg-9">
            @include('Kayıtsız_Görüntülemeler.layouts._message')
        </div>

        @if ($blogs->count() > 3)
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 mb-5">
                        <h2 class="h5 section-title">Trending Posts</h2>

                        @foreach ($trend_blogs as $blog)
                            <article class="card mb-4">
                                <div class="card-body d-flex">
                                    <img class="trend-blog-image" style="width: 50%; height:50%;"
                                        src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                        class="card-img-top" alt="post-thumb">
                                    <div class="ml-3">
                                        <h4><a href="{{ route('blogs.show', $blog->id) }}"
                                                class="post-title">{{ $blog->title }}</a>
                                        </h4>
                                        <ul class="card-meta list-inline mb-0">
                                            <li class="list-inline-item mb-0">
                                                <i class="ti-calendar"></i>{{ $blog->created_at->format('d-m-Y') }}
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="ti-timer"></i>2 Min To Read
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="col-lg-6 mb-5">
                        <h2 class="h5 section-title">Most Popular Post</h2>

                        <article class="card">
                            <div class="post-slider slider-sm">
                                <img src="{{ asset('blog_images/cover_photos/') }}/{{ $populer_post->cover_photo }}"
                                    class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="h4 mb-3"><a class="post-title"
                                        href="{{ route('blogs.show', $populer_post->id) }}">{{ $populer_post->title }}</a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('profile.other.show', $populer_post->user_id) }}"
                                            class="card-meta-author">
                                            @if ($populer_post->user->photo)
                                                <img src="{{ asset('uploads/' . $populer_post->user->photo) }}"
                                                    alt="Author Image">
                                            @else
                                                <img src="/img/Default_pfp.jpg" alt="Author Image">
                                            @endif
                                            <span>{{ $populer_post->user->name }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i>2 Min To Read
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar"></i>{{ $populer_post->created_at->format('d-m-Y') }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            <li class="list-inline-item"><a
                                                    href="{{ route('show.blogs', $populer_post->category_id) }}">{{ $populer_post->get_category($populer_post) }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <p>{{ $populer_post->summery }}</p>
                                <a href="{{ route('blogs.show', $populer_post->id) }}"
                                    class="btn btn-outline-primary">Read
                                    More</a>
                            </div>
                        </article>
                    </div>
                    <div class="col-12">
                        <div class="border-bottom border-default"></div>
                    </div>
                </div>
            </div>
        @endif

    </section>

    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8  mb-5 mb-lg-0">
                    <h2 class="h5 section-title">Recent Posts</h2>


                    @if (isset($blogs))
                        @foreach ($blogs as $blog)
                            <article class="card mb-4">
                                <div class="row card-body">
                                    <div class="col-md-4 mb-md-0 justify-content-center">
                                        <div class="post-slider slider-sm slick-initialized slick-slider">
                                            <div class="slick-list draggable">
                                                <div class="post-slider slider-sm">
                                                    <img style="border-radius: 5px"
                                                        src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                                        class="card-img-top" alt="post-thumb">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h3 class="h4 mb-3"><a class="post-title"
                                                href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                        </h3>
                                        <ul class="card-meta list-inline">
                                            <li class="list-inline-item">
                                                <a href="{{ route('profile.other.show', $blog->user_id) }}"
                                                    class="card-meta-author">
                                                    @if ($blog->user->photo)
                                                        <img src="{{ asset('uploads/' . $blog->user->photo) }}"
                                                            alt="Author Image">
                                                    @else
                                                        <img src="/img/Default_pfp.jpg" alt="Author Image">
                                                    @endif
                                                    <span>{{ $blog->user->name }}</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ti-timer"></i>3 Min To Read
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ti-calendar"></i>{{ $blog->created_at->format('d-m-Y') }}
                                            </li>
                                            <li class="list-inline-item">
                                                <ul class="card-meta-tag list-inline">
                                                    <li class="list-inline-item"><a
                                                            href="{{ route('show.blogs', $blog->category_id) }}">{{ $blog->get_category($blog) }}</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <p>{{ $blog->summery }}</p>
                                        <a href="{{ route('blogs.show', $blog->id) }}"
                                            class="btn btn-outline-primary">Read More</a>
                                    </div>
                                </div>
                            </article>
                            {{-- <article class="card mb-4">
                                <div class="post-slider">
                                    <img style="max-height: 500px"
                                        src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                        class="card-img-top" alt="post-thumb">
                                </div>
                                <div class="card-body">
                                    <h3 class="mb-3"><a class="post-title"
                                            href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{ route('profile.other.show', $blog->user_id) }}"
                                                class="card-meta-author">
                                                @if ($blog->user->photo)
                                                    <img src="{{ asset('uploads/' . $blog->user->photo) }}"
                                                        alt="Author Image">
                                                @else
                                                    <img src="/img/Default_pfp.jpg" alt="Author Image">
                                                @endif
                                                <span>{{ $blog->user->name }}</span>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>3 Min To Read
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-calendar"></i>{{ $blog->created_at->format('d-m-Y') }}
                                        </li>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                <li class="list-inline-item"><a
                                                        href="{{ route('show.blogs', $blog->category_id) }}">{{ $blog->get_category($blog) }}</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <p>{{ $blog->summery }}</p>
                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                        class="btn btn-outline-primary">Read More</a>
                                </div>
                            </article> --}}
                        @endforeach
                    @endif
                    <ul class="pagination justify-content-center">
                        {{ $blogs->links() }}
                    </ul>


                </div>

                <aside class="col-lg-4 sidebar-home">


                    <!-- categories -->
                    <div class="widget widget-categories" style="position: relative;">
                        <h4 class="widget-title"><span>Categories</span></h4>

                        <div class="search-container justify-content-center d-flex" style="position: relative;">
                            <livewire:category-search-component :all_categories="$categories" />

                        </div>

                    </div><!-- tags -->

                    <!-- authors -->
                    <div class="widget widget-author">
                        <h4 class="widget-title">Authors</h4>
                        @if (isset($populer_users))
                            @foreach ($populer_users as $p_user)
                                <div class="media align-items-center">
                                    <div class="mr-3">
                                        @if ($p_user->photo)
                                            <img src="{{ asset('uploads/' . $p_user->photo) }}" alt="Author Image">
                                        @else
                                            <img src="/img/Default_pfp.jpg" alt="Author Image">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mb-1"><a class="post-title"
                                                href="{{ route('profile.other.show', $p_user->id) }}">{{ $p_user->name }}</a>
                                        </h5>
                                        <span>User Bio Here</span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                        @endif


                    </div>


                    <div class="widget">
                        <h4 class="widget-title">Recent Posts</h4>

                        @foreach ($recent_blogs as $blog)
                            <article class="widget-card">
                                <div class="d-flex">
                                    <img style="width: 40%; height:40%; border-radius:5px;"
                                        src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                        class="trend-blog-image" alt="post-thumb">
                                    <div class="ml-3">
                                        <h5><a class="post-title"
                                                href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                        </h5>
                                        <ul class="card-meta list-inline mb-0">
                                            <li class="list-inline-item mb-0">
                                                <i class="ti-calendar"></i>{{ $blog->created_at->format('d-m-Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        @endforeach





                    </div>

                    {{-- editor seçimi --}}
                    <div class="widget">
                        <div class="col-12 mb-5">
                            <h2 class="h5 section-title">Editor's Pick</h2>
                            @if (isset($editors_blog))
                                <article class="card">
                                    <div class="post-slider slider-sm">
                                        <img src="{{ asset('blog_images/cover_photos/') }}/{{ $editors_blog->cover_photo }}"
                                            class="card-img-top" alt="post-thumb">
                                    </div>

                                    <div class="card-body">
                                        <h3 class="h4 mb-3"><a class="post-title"
                                                href="{{ route('blogs.show', $editors_blog->id) }}">{{ $editors_blog->title }}</a>
                                        </h3>
                                        <ul class="card-meta list-inline">
                                            <li class="list-inline-item">
                                                <a href="{{ route('profile.other.show', $editors_blog->user_id) }}"
                                                    class="card-meta-author">
                                                    @if ($editors_blog->user->photo)
                                                        <img src="{{ asset('uploads/' . $editors_blog->user->photo) }}"
                                                            alt="Author Image">
                                                    @else
                                                        <img src="/img/Default_pfp.jpg" alt="Author Image">
                                                    @endif
                                                    <span>{{ $editors_blog->user->name }}</span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <i class="ti-timer"></i>2 Min To Read
                                            </li>
                                            <li class="list-inline-item">
                                                <i
                                                    class="ti-calendar"></i>{{ $editors_blog->created_at->format('d-m-Y') }}
                                            </li>
                                            <li class="list-inline-item">
                                                <ul class="card-meta-tag list-inline">
                                                    <li class="list-inline-item"><a
                                                            href="{{ route('show.blogs', $editors_blog->category_id) }}">{{ $editors_blog->get_category($editors_blog) }}</a>
                                                    </li>

                                                </ul>
                                            </li>
                                        </ul>
                                        <p>{{ $editors_blog->summery }}</p>
                                        <a href="{{ route('blogs.show', $editors_blog->id) }}"
                                            class="btn btn-outline-primary">Read
                                            More</a>
                                    </div>
                                </article>
                            @endif

                        </div>
                    </div>

                </aside>


            </div>
        </div>
    </section>



    @include('Normal_Kullanıcı/blogy_Layouts.footer')
    @livewireScripts









</body>

</html>
