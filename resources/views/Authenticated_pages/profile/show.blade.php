<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

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


    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">

    <title>{{ $site_setting->site_name }}</title>


    @include('Authenticated_pages.layouts.header_style')


</head>

<body>
<!-- navigation -->
@include('Authenticated_pages.layouts.header')

@include('Authenticated_pages.layouts.spinner')


<div id="searchResults" class="search-results" style="display: none; width:50%; margin-left:25%; margin-top:80px">
</div>

<div class="author">
    <div class="container">
        <div class="row no-gutters justify-content-center">
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                <img src="{{ asset('uploads/' . $user->photo) }}" class="author-image">
            </div>
            <div class="col-md-8 col-lg-6 text-center text-md-left">


                <h2 class="mb-2 ">{{ $user->name }}</h2>


                <strong class="mb-2 d-block">{{ $user->skill }}</strong>
                <div class="content">
                    <p>{{ $user->bio }}</p>

                </div>

                <a class="post-count mb-1" href="#"><i class="ti-pencil-alt mr-2"></i><span
                        class="text-primary">{{ $blogs->count() }}</span> Posts by YOU</a>
                <ul class="list-inline social-icons">

                    <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

                    <li class="list-inline-item"><a href="#"><i class="ti-link"></i></a></li>

                </ul>
            </div>
        </div>
    </div>

    <svg class="author-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
              stroke="#040306" stroke-miterlimit="10"/>
        <path class="path"
              d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
        <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
              stroke-miterlimit="10"/>
    </svg>


    <svg class="author-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
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


    <svg class="author-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
              stroke="#040306" stroke-miterlimit="10"/>
        <path class="path"
              d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
        <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z"
              stroke="#040306" stroke-miterlimit="10"/>
    </svg>


    <svg class="author-border" height="240" viewBox="0 0 2202 240" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
            stroke-width="2"/>
    </svg>
</div>

<section class="section-sm" id="post">
    <div class="container">
        <div class="row">

            <div class="alerts col-lg-8 mx-auto" style="margin-bottom: 30px;">
                @include('Public_pages.layouts._message')
            </div>

            @if (isset($blogs))
                @foreach ($blogs as $blog)
                    <div class="col-lg-10 mx-auto">
                        <article class="card mb-4">

                            @if (isset($blog->cover_photo))
                            <div class="post-slider">
                                <img style="max-height: 400px"
                                    src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                    class="card-img-top" alt="post-thumb">
                            </div>
                            @endif

                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title"
                                                    href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                                </h3>
                                <ul class="card-meta list-inline">

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
                                            <li class="list-inline-item">
                                                <a href="{{ route('show.blogs', $blog->category_id) }}">
                                                    {{ $blog->get_category($blog) }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    @if (!$blog->is_confirmed)
                                        <li class="list-inline-item">
                                            <span class="alert alert-danger">In the approval process</span>
                                        </li>
                                    @endif


                                </ul>
                                <p>{{ $blog->summery }}</p>


                                <div class="dropup-center  dropup">
                                    <a href="{{ route('blogs.show', $blog->id) }}"
                                    class="btn btn-outline-primary">
                                        Read More
                                    </a>
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        More
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item btn-outline-primary"
                                            href="{{ route('myBlogs.edit', $blog->id) }}">Edit</a></li>
                                        <li><a class="dropdown-item btn-outline-primary"
                                            style="color:red; background-color:white;"
                                            onclick="clickedDelete({{ $blog->id }})">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>


@include('Authenticated_pages.layouts.footer')

<script>
    function clickedDelete(blog_id) {
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamazsınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Evet, sil!',
            cancelButtonText: 'Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
                // Silme işlemi burada yapılabilir
                $(document).ready(function () {
                    var blogId = blog_id;

                    $.ajax({
                        url: "{{ route('myBlogs.deleted') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            blog_id: blogId
                        },
                        success: function (response) {
                            if (response.success) {

                                Swal.fire(
                                    'Silindi!',
                                    'Blog başarıyla silindi.',
                                    'success'
                                );
                                window.location.reload();
                            } else {
                                alert('AJAX HATASI');
                            }
                        },
                        error: function (xhr) {
                            alert(xhr.responseText)
                        }
                    });

                });
            } else {
                // Vazgeçildiğinde yapılacak işlemler (gerekirse)


                Swal.fire(
                    'İptal Edildi',
                    'Silme işlemi iptal edildi.',
                    'error'
                );
            }
        });
    }
</script>


</body>

</html>
