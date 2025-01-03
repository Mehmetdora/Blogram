<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>{{ $site_setting->site_name }}</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Hugo 0.74.3"/>

    <!-- theme meta -->
    <meta name="theme-name" content="reader"/>


    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">

    @livewireStyles

    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f5f5;
        }

        .container-categories {
            z-index: 10;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
        }

        .container-categories h1 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .categories {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .category-btn {
            padding: 0.75rem 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 50px;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            min-width: 120px;
            position: relative;
        }

        .category-btn::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #e0e0e0;
            transition: background-color 0.3s ease;
        }

        .category-btn:hover {
            border-color: #4CAF50;
        }

        .category-btn.active {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
        }

        .category-btn.active::before {
            background-color: white;
        }

        .save-btn {
            display: block;
            margin: 0 auto;
            padding: 0.75rem 2.5rem;
            border: 2px solid #333;
            border-radius: 50px;
            background: transparent;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background: #333;
            color: white;
        }

        @media (max-width: 480px) {
            .categories {
                flex-direction: column;
                align-items: stretch;
            }

            .category-btn {
                width: 100%;
            }
        }

        .selected {
        }
    </style>


    @include('Authenticated_pages.layouts.header_style')

</head>


<body>

<header class="header " style="width: 100%">
    <div class="logo">
        <a href="{{ route('home') }}"> <img
                src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}" alt="Logo"
                class="logo-img">
        </a>
    </div>
    <div class="search-container  " style="position: relative; display:flex;">
        <livewire:search-component/>
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
                <hr class="custom-hr">
                <a class=" sign-out" href="# ">Sign Out</a>
            </div>
        </div>
    </nav>
    <button class="menu-toggle">☰</button>
</header>

<div class="banner text-center" style="width: 100%">


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
            <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979"
                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                <feColorMatrix in="SourceAlpha" type="matrix"
                               values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"/>
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
        <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z"
              stroke="#040306" stroke-miterlimit="10"/>
    </svg>


    <svg class="banner-border" height="240" viewBox="0 0 2202 240" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
            stroke-width="2"/>
    </svg>
</div>

@include('Public_pages.layouts._message')

@include('Authenticated_pages.layouts.spinner')


<div class="container-categories" style="flex:1">
    <h1>CATEGORIES</h1>
    <div class="categories">
        @if (isset($categories))
            @foreach ($categories as $category)
                <button class="category-btn @if ($category->isAdded($category)) active @endif"
                        id="{{ $category->id }}">{{ $category->name }}</button>
            @endforeach
        @endif
    </div>
    <form id="category_selection" action="{{ route('added_more_categories') }}" method="post">
        @csrf
        <input type="hidden" name="selectedCategories" id="selectedCategories" value="">
        <button type="submit" class="save-btn">SAVE</button>
    </form>

</div>


<!-- Kendi JS dosyalarım -->
<script src="{{ asset('style/reader/JS/') }}/header.js"></script>
<script src="{{ asset('style/reader/') }}/plugins/jQuery/jquery.min.js"></script>
<script src="{{ asset('style/reader/') }}/plugins/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('style/reader/') }}/plugins/slick/slick.min.js"></script>
<script src="{{ asset('style/reader/') }}/plugins/instafeed/instafeed.min.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    const input_selecteds_catg = document.getElementById('selectedCategories');
    document.querySelectorAll('.category-btn').forEach(button => {
        button.addEventListener('click', function () {
            this.classList.toggle('active');
            const selectedCategories = Array.from(document.querySelectorAll('.category-btn.active'))
                .map(btn => btn.id);
            input_selecteds_catg.value = selectedCategories;


            // Add subtle animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
        });
    });
</script>

<footer class="footer" style="width:100%">
    <svg class="footer-border" height="214" viewBox="0 0 2204 214" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M2203 213C2136.58 157.994 1942.77 -33.1996 1633.1 53.0486C1414.13 114.038 1200.92 188.208 967.765 118.127C820.12 73.7483 263.977 -143.754 0.999958 158.899"
            stroke-width="2"/>
    </svg>


    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center text-md-left mb-4">
                <ul class="list-inline footer-list mb-0">
                    <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="#">Terms Conditions</a></li>
                </ul>
            </div>
            <div class="col-md-2 text-center mb-4">
                <a href="{{ route('home') }}"> <img
                        src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}"
                        alt="Logo" class="logo-img">
                </a>
            </div>
            {{-- <div class="col-md-5 text-md-right text-center mb-4">
            <ul class="list-inline footer-list mb-0">

                <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

                <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

                <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>

                <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

                <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

            </ul>
        </div> --}}
            <div class="col-12">
                <div class="border-bottom border-default"></div>
            </div>
        </div>
    </div>
</footer>

<!-- JS Plugins READER -->
<script src="{{ asset('style/') }}/reader/plugins/jQuery/jquery.min.js"></script>
<script src="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('style/') }}/reader/plugins/slick/slick.min.js"></script>
<script src="{{ asset('style/') }}/reader/plugins/instafeed/instafeed.min.js"></script>
<!-- Main Script -->
<script src="{{ asset('style/') }}/reader/jsn/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

{{-- logout alert --}}
<script>
    $(document).ready(function () {
        $('.sign-out').on('click', function () {
            Swal.fire({
                title: "Logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    // GET isteği ile logout işlemi
                    window.location.href = "{{ route('logout') }}";
                }
            });
        });
    });
</script>

{{-- spinner --}}
<script>
    // public/js/loader.js
    document.addEventListener("DOMContentLoaded", function () {
        // Sayfa yüklendiğinde spinner'ı gizle
        document.getElementById("loader").style.display = "none";

        // Form gönderildiğinde spinner'ı göster
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                document.getElementById("loader").style.display = "flex";
            });
        });
    });

    // Sayfa yüklendiğinde spinner'ı gizle
    window.addEventListener("load", function () {
        document.getElementById("loader").style.display = "none"; // Sayfa yüklendiğinde spinner'ı gizle
    });
</script>

{{-- notification bell mobile href ekleme --}}
<script>
    function checkWidthAndSetHref() {
        const button = document.getElementById('notification-bell');
        const notifications = document.getElementById('notificationDropdown');

        if (window.innerWidth < 1000) {
            // Butona href eklemek için `a` öğesi oluştur veya yönlendirme için kod ekle
            button.onclick = function () {
                notifications.style.display = 'none';
                window.location.href = '{{ route('show_notifications') }}'; // Yeni URL
            };
        } else {
            // Butonun href özelliğini kaldır
            button.onclick = null;
        }
    }

    // İlk yüklemede kontrol et
    checkWidthAndSetHref();

    // Pencere yeniden boyutlandırıldığında kontrol et
    window.addEventListener('resize', checkWidthAndSetHref);
</script>

{{-- dropdown --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuToggle = document.querySelector('.menu-toggle');
        const nav = document.querySelector('.nav');
        const dropdowns = document.querySelectorAll('.dropdown');

        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('active');
            // Removed: document.body.classList.toggle('menu-open');
        });

        dropdowns.forEach(dropdown => {
            const dropbtn = dropdown.querySelector('.dropbtn');
            dropbtn.addEventListener('click', (e) => {
                e.preventDefault();

                // Close other dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown && otherDropdown.classList.contains(
                        'active')) {
                        otherDropdown.classList.remove('active');
                    }
                });

                // Toggle current dropdown
                dropdown.classList.toggle('active');
            });
        });

        function closeMobileMenu() {
            nav.classList.remove('active');
            // Removed: document.body.classList.remove('menu-open');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown') && !e.target.closest('.menu-toggle')) {
                dropdowns.forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
                closeMobileMenu();
            }
        });
    });
</script>
@livewireScripts
</body>

</html>
