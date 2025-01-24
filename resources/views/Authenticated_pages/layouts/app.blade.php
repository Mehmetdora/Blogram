<!doctype html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <meta name="description" content=""/>
    <meta name="keywords" content="bootstrap, bootstrap5"/>

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


    @include('Authenticated_pages.layouts.header_style')

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
        <livewire:search-component/>
    </div>
    <nav class="nav" style="margin-left: 10px">
        <a href="{{ route('myBlogs.create') }}" class="nav-link">Write</a>

        <div class="dropdown">
            <button class="dropbtn">My Categories<span class="arrow">▼</span></button>
            <div class="dropdown-content">
                @if (isset($user_categories))
                    @foreach ($user_categories as $category)
                        <a href="{{ route('show.blogs', $category->id) }}">
                            {{ $category->name }}({{ $category->blogs_count }})
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
                              d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5"/>
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
                <a href="{{route('logined_user_contact')}}">Contact</a>
                <hr class="custom-hr">
                <a class=" sign-out" href="# ">Sign Out</a>
            </div>
        </div>
    </nav>
    <button class="menu-toggle">☰</button>
</header>



@include('Authenticated_pages.layouts.spinner')


<section class="section pb-0">
    <div class="container col-lg-9">
        @include('Public_pages.layouts._message')
    </div>

    @if ($blogs->count() > 3)
        <div class="container">
            <div class="row">

                <div class="col-lg-6 mb-5">
                    <h2 class="h5 section-title">Trending Posts</h2>

                    @foreach ($trend_blogs as $blog)
                        <article class="card mb-4">
                            <div class="card-body d-flex">
                                @if (isset($blog->cover_photo))
                                    <img class="trend-blog-image" style="width: 50%; height:50%;"
                                    src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                    class="card-img-top" alt="post-thumb">
                                @endif
                                <div class="ml-3">
                                    <h4><a href="{{ route('blogs.show', $blog->id) }}"
                                           class="post-title">{{ $blog->title }}</a>
                                    </h4>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>{{ $blog->created_at->format('d-m-Y') }}
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-timer"></i>
                                            @if ($blog->min_to_read < 1)
                                                Less Then 1 Min To Read
                                            @else
                                                {{ $blog->min_to_read }} Min To Read
                                            @endif
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
                        @if (isset($blog->cover_photo))
                            <div class="post-slider slider-sm">
                                <img src="{{ asset('blog_images/cover_photos/') }}/{{ $populer_post->cover_photo }}"
                                    class="card-img-top" alt="post-thumb">
                            </div>
                        @endif
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
                                    <i class="ti-timer"></i>
                                    @if ($blog->min_to_read < 1)
                                        Less Then 1 Min To Read
                                    @else
                                        {{ $blog->min_to_read }} Min To Read
                                    @endif
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
                        @if (isset($blog->cover_photo))
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
                                                <i class="ti-timer"></i>
                                                @if ($blog->min_to_read < 1)
                                                    Less Then 1 Min To Read
                                                @else
                                                    {{ $blog->min_to_read }} Min To Read
                                                @endif
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

                                    </div>
                                </div>
                            </article>
                        @else
                            <article class="card mb-4">
                                <div class="row card-body">
                                    <div class="col-12">
                                        <h3 class="h4 mb-3"><a class="post-title" href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                        <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{ route('profile.other.show', $blog->user_id) }}" class="card-meta-author">
                                                <img src="{{ asset('uploads/' . $blog->user->photo) }}"
                                                alt="Author Image">
                                                <span>{{$blog->user->name}}</span>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>
                                            @if ($blog->min_to_read < 1)
                                                Less Then 1 Min To Read
                                            @else
                                                {{ $blog->min_to_read }} Min To Read
                                            @endif
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
                                    </div>
                                </div>
                            </article>
                        @endif
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

                    <div class="search-container justify-content-center d-flex" style=" position: relative;">
                        <livewire:category-search-component :all_categories="$categories"/>

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
                                    <span>{{$p_user->skill}}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <a href="{{route('users_all')}}">
                        <h6 class="widget-title ">All Users</h6>
                    </a>


                </div>




                {{-- editor seçimi --}}
                <div class="widget">
                    <div class="col-12 mb-5">
                        <h2 class="h5 section-title">Editor's Pick</h2>
                        @if (isset($editors_blog))
                            <article class="card">

                                @if (isset($editors_blog->cover_photo))
                                    <div class="post-slider slider-sm">
                                        <img src="{{ asset('blog_images/cover_photos/') }}/{{ $editors_blog->cover_photo }}"
                                            class="card-img-top" alt="post-thumb">
                                    </div>
                                @endif
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
                                            <i class="ti-timer"></i>
                                            @if ($editors_blog->min_to_read < 1)
                                                Less Then 1 Min To Read
                                            @else
                                                {{ $editors_blog->min_to_read }} Min To Read
                                            @endif
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


@include('Authenticated_pages/layouts.footer')
@livewireScripts


</body>

</html>
