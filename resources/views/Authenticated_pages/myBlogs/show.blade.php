<!-- /*
* Template Name: Blogy
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!doctype html>
<html lang="en">

<!-- Header -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content=""/>
    <meta name="keywords" content="bootstrap, bootstrap5"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('blogy/')}}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{asset('blogy/')}}/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{asset('blogy/')}}/css/tiny-slider.css">
    <link rel="stylesheet" href="{{asset('blogy/')}}/css/aos.css">
    <link rel="stylesheet" href="{{asset('blogy/')}}/css/glightbox.min.css">
    <link rel="stylesheet" href="{{asset('blogy/')}}/css/style.css">

    <link rel="stylesheet" href="{{asset('blogy/')}}/css/flatpickr.min.css">

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css"/>


    <title>{{ $site_setting->site_name }}</title>

    <style>
        .notification-dropdown {
            width: 300px;
            max-height: 500px;
            overflow-y: auto;
            position: absolute;
            top: 100%;
            /* Position it right below the button */
            left: 0;
            /* Align it with the left edge of the button */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
            /* Ensure it appears above other content */
        }

        .notification-container {
            position: relative;
            display: inline-block;
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #f0f0f0;
        }

        .notification-item:hover {
            background-color: gainsboro
        }

        .notification-icon-header {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }

        .notification-icon {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }

        .notification-title {
            font-weight: bold;
            margin-bottom: 0;
        }

        .notification-description {
            color: #777;
            font-size: 0.9em;
            margin-bottom: 0;
        }

        .notification-time {
            font-size: 0.8em;
            color: #999;
        }
    </style>

    <style>
        .description {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>


</head>
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">
                <div class="row g-0 align-items-center">
                    <div class="col-2">
                        <a href="{{route('home')}}" class="logo m-0 float-start">Blogy<span
                                class="text-primary">.</span></a>
                    </div>
                    <div class="col-2 text-end">
                        <a href="#"
                           class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                            <span></span>
                        </a>

                    </div>
                    <div class="col-8 text-center">


                        <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu mx-auto">
                            <li class="active"><a href="{{route('home')}}">Home</a></li>
                            <li class="active"><a href="{{route('myBlogs.create')}}">Create</a></li>
                            <li class="has-children">
                                <a href="category.html">Categories</a>
                                <ul class="dropdown">
                                    @if(isset($categories))
                                        @foreach($categories as $category)
                                            <li><a href="{{route('show.blogs',$category->id)}}">{{$category->name}}
                                                    ({{\App\Models\Blog::where('category_id',$category->id)->where('status',1)->count()}}
                                                    )</a></li>
                                        @endforeach
                                    @else
                                        <li><a href="search-result.html">No Category Yet</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="has-children">
                                <a href="">Categories</a>
                                <ul class="dropdown">
                                    @if (isset($categories))
                                        @foreach ($categories as $category)
                                            <li><a
                                                    href="{{ route('show.blogs', $category->id) }}">{{ $category->name }}
                                                    ({{ \App\Models\Blog::where('category_id', $category->id)->where('status',1)->count() }}
                                                    )</a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li><a href="search-result.html">No Category Yet</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="has-children">
                                <a>Profile</a>
                                <ul class="dropdown">
                                    <li><a href="{{route('profile.show')}}">Profile</a></li>
                                    <li><a href="blog.html">My Blogs</a></li>
                                    <li><a href="blog.html">Statics</a></li>
                                    <hr>
                                    <li class="sign-out"><a>Sign out
                                            <br>{{\Illuminate\Support\Facades\Auth::user()->name}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>

<body>

<section class="section">
    <div class="container">

        <div class="row mb-4">
            <div class="col-sm-6">
                <h2 class="posts-entry-title">{{$selectedCategory->name}}</h2>
            </div>
            <div class="col-sm-6 text-sm-end"><a href="{{route('home')}}" class="read-more">View All</a></div>
        </div>

        <div class="row">
            @if(isset($blogs))
                @foreach($blogs as $blog)
                    <div class="col-lg-6 mb-6">
                        <div class="post-entry-alt">
                            <a href="" class="img-link">
                                @if($blog->profile->photo)
                                    <img src="{{ asset('uploads/' . $blog->profile->photo) }}" alt="Author Image">
                                @else
                                    <img src="/img/Default_pfp.jpg" alt="Author Image">
                                @endif
                            </a>
                            <div class="excerpt">


                                <h2><a href="">{{$blog->title}}</a></h2>
                                <div class="post-meta align-items-center text-left clearfix">
                                    <figure class="author-figure mb-0 me-3 float-start">
                                        @if($blog->profile->photo)
                                            <img src="{{ asset('uploads/' . $blog->profile->photo) }}"
                                                 alt="Author Image">
                                        @else
                                            <img src="/img/Default_pfp.jpg" alt="Author Image">
                                        @endif
                                    </figure>
                                    <span class="d-inline-block mt-1">By <a
                                            href="#">{{$blog->profile->profile_name}}</a></span>
                                    <span>&nbsp;-&nbsp; {{$blog->created_at->diffForHumans()}}</span>
                                </div>

                                <p class="description">{!! $blog->description !!}</p>
                                <p><a href="" class="read-more">Continue Reading</a></p>
                            </div>
                        </div>
                    </div>

                @endforeach
            @endif

        </div>

    </div>
</section><!-- Bloglar - contents -->


<!-- Footer -->
@include('Authenticated_pages.layouts.footer')


</body>
</html>
