<!doctype html>
<html lang="tr">

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


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">

    @livewireStyles

    <title>{{ $site_setting->site_name }}</title>
    @include('Authenticated_pages.layouts.header_style')

</head>

<body>

    @include('Authenticated_pages.layouts.header')
    <div class="banner text-center">


        <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                  stroke="#040306" stroke-miterlimit="10"/>
            <path class="path"
                  d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                  stroke-miterlimit="10"/>
        </svg>

        <svg class="banner-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                      d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z"/>
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10"/>
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse"
                        color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
                    <feOffset dy="4"/>
                    <feGaussianBlur stdDeviation="2"/>
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow"/>
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"/>
                </filter>
            </defs>
        </svg>


        <svg class="banner-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                  stroke="#040306" stroke-miterlimit="10"/>
            <path class="path"
                  d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                  stroke-miterlimit="10"/>
        </svg>


        <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2"/>
        </svg>
    </div>


    <div class="container col-lg-8 justify-content-center">
        @include('Public_pages.layouts._message')
    </div>

    @include('Authenticated_pages.layouts.spinner')


    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">


                <div class="col-lg-10  mb-5 mb-lg-0">
                    <h2 class="h5 section-title">All Saved Blogs</h2>


                    @if (isset($saved_blogs))
                        @foreach ($saved_blogs as $blog)
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

                    <ul class="pagination mt-4 justify-content-center">
                        {{ $saved_blogs->links() }}
                    </ul>
                </div>


            </div>
        </div>
    </section>


    @include('Authenticated_pages/layouts.footer')
    @livewireScripts

</body>

</html>
