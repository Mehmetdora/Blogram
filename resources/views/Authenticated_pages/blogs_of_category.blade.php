<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">
    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">


    <title>{{ $site_setting->site_name }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .widget-categories {
            max-height: 350px;
            overflow-y: auto;

        }

        .trend-blog-image {
            width: 85px;
            height: 85px;
        }
    </style>

    @include('Authenticated_pages.layouts.header_style')

</head>

<body style="margin-top: 10px">

    @include('Authenticated_pages.layouts.header')
    <div class="banner text-center">


        <svg class="banner-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
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
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979" filterUnits="userSpaceOnUse"
                    color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
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
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>
    @include('Public_pages.layouts._message')
    @include('Authenticated_pages.layouts.spinner')


    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8  mb-5 mb-lg-0">


                    <div class="col-sm-12 posts-entry-title d-flex align-items-center">
                        <h2 class="col-mb-4 mr-4">{{ $selectedCategory->name }}</h2>
                        <a href="#"
                            class="btn col-mb-6
                            @if ($selectedCategory->isAdded($selectedCategory)) category-added @endif"
                            id="add-category-btn" data-category-id="{{ $selectedCategory->id }}">{{ $buttonText }}
                        </a>
                    </div>


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
                            {{-- büyük fotoğralı blog --}}
                            {{--  <article class="card mb-4">
                            <div class="post-slider">
                                <img style="max-height: 500px"
                                     src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                     class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title"
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
                    <div class="widget widget-categories">
                        <h4 class="widget-title"><span>Categories</span></h4>

                        <div class="search-container justify-content-center d-flex" style=" position: relative;">
                            <livewire:category-search-component :all_categories="$categories" />

                        </div>

                    </div>

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
                        @endif
                        <a href="{{ route('users_all') }}">
                            <h6 class="widget-title ">All Users</h6>
                        </a>


                    </div>



                </aside>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('Authenticated_pages.layouts.footer')


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#add-category-btn').on('click', function(event) {
                event.preventDefault(); // Sayfanın yenilenmesini önler
                var button = $(this);
                var categoryId = button.data('category-id');

                if (button.hasClass('category-added')) {
                    // Silme işlemi
                    $.ajax({
                        url: "{{ route('myCategory.deleted') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            category_id: categoryId
                        },
                        success: function(response) {
                            if (response.success) {
                                button.text('ADD');
                                button.removeClass('category-added'); // Sınıfı kaldırıyoruz

                                Swal.fire({
                                    icon: "success",
                                    title: "Kategori Listenden Kaldırıldı!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                alert('AJAX HATASI');
                            }
                        },
                        error: function(xhr) {
                            alert(xhr.responseText)
                        }
                    });
                } else {
                    // Ekleme işlemi
                    $.ajax({
                        url: "{{ route('myCategory.added') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            category_id: categoryId
                        },
                        success: function(response) {
                            if (response.success) {
                                button.text('✓');
                                button.addClass('category-added'); // Sınıfı ekliyoruz

                                Swal.fire({
                                    icon: "success",
                                    title: "Kategori Listene Eklendi!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                alert('AJAX HATASI');
                            }
                        },
                        error: function(xhr) {
                            alert(xhr.responseText)
                        }
                    });
                }
            });
        });
    </script>


</body>

</html>
