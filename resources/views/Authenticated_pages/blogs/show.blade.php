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


    <link rel="stylesheet" href="{{ asset('highlight/') }}/styles/monokai.css">


    <!-- READER CSS -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">
    <link rel="stylesheet" href="{{ asset('style/reader/css/blogStyle.css') }}">


    <title>{{ $site_setting->site_name }}</title>
    @include('Authenticated_pages.layouts.header_style')

    {{-- Tags Badge --}}
    <style>
        .tag {
            position: relative;
            margin: 10px;
            text-decoration: underline;
            text-underline-offset: 4px;
            /* Çizgi ile metin arasındaki mesafe */
            text-decoration-thickness: 2px;
            /* Çizgi kalınlığı */
            border-color: rgb(255, 119, 0);
            border-width: 10px;
            color: rgb(0, 0, 0);

        }

        .tag::before,
        .tag::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #fc2f70;
            transform: scaleY(0);
            transition: transform 0.5s ease;
        }

        .tag::before {
            left: -8px;
            transform-origin: center top;
        }

        .tag::after {
            right: -8px;
            transform-origin: center bottom;
        }
    </style>

    <style>
        .trend-blog-image {
            width: 85px;
            height: 85px;
        }

        .hide {
            display: none;
        }

        .show {
            display: block;
        }

        .content {
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>

    {{-- zoom modal --}}
    <style>
        /* Modal kaplama */
        #image-modal {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            top: 25%;
            left: 3%;
            width: 94%;
            height: 70%;
            top: 15%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        /* Modal açıldığında */
        #image-modal.show {
            display: flex;
            opacity: 1;
            transform: scale(1);
        }

        /* Popup içindeki resim */
        #modal-image {
            max-width: 90%;
            /* Sayfanın genişliğinin 3/4'ü */
            max-height: 90%;
            /* Sayfanın yüksekliğinin 3/4'ü */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Kapatma butonu */
        #close-modal {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: white;
            background: rgba(0, 0, 0, 0.5);
            width: 40px;
            /* Genişlik ve yüksekliği eşit yaparak daire şeklini sağlar */
            height: 40px;
            border-radius: 50%;
            /* Daire şekli */
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        #close-modal:hover {
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
            cursor: pointer;
        }
    </style>

    {{-- like button --}}
    <style>
        /* From Uiverse.io by KSAplay */
        .like-btn {
            background-color: #c6deff;
        }

        .like-btn input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .like-btn {
            display: block;
            position: relative;
            cursor: pointer;
            font-size: 25px;
            user-select: none;
            transition: 100ms;
        }

        .checkmark {
            top: 0;
            left: 0;
            height: 2em;
            width: 2em;
            transition: 100ms;
            animation: dislike_401 400ms ease;


        }

        .like-btn input:checked~.checkmark path {
            fill: #1C7DFF;
            stroke-width: 1.2;
            stroke: #212121;
            /*same background color*/
        }

        .like-btn input:checked~.checkmark {
            animation: like_401 400ms ease;
        }

        .like-btn:hover {
            transform: scale(1.1);
        }

        @keyframes like_401 {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes dislike_401 {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>

    {{-- save button --}}
    <style>
        /* From Uiverse.io by vinodjangid07 */
        #checkboxInput {
            display: none;
        }

        .bookmark {
            cursor: pointer;
            background-color: teal;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .svgIcon path {
            stroke-dasharray: 200 0;
            stroke-dashoffset: 0;
            stroke: white;
            fill: #dddddd00;
            transition-delay: 0s;
            transition-duration: 0.5s;
        }

        #checkboxInput:checked~.svgIcon path {
            fill: white;
            animation: bookmark 0.5s linear;
            transition-delay: 0.5s;
        }

        @keyframes bookmark {
            0% {
                stroke-dasharray: 0 200;
                stroke-dashoffset: 80;
            }

            100% {
                stroke-dasharray: 200 0;
            }
        }
    </style>

    {{-- reaction bar --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #333;
        }

        .reaction-bar {
            max-width: 100%;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1px solid #e0e0e0;
            border-bottom: 1px solid #e0e0e0;
        }

        .reaction-left {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .reaction-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .reaction-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #757575;
            cursor: pointer;
            transition: color 0.2s ease;
            background: none;
            border: none;
            font-size: 14px;
        }

        .reaction-item:hover {
            color: #333;
        }

        .reaction-item.active {
            color: #1a73e8;
        }

        .icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 480px) {
            .reaction-bar {
                padding: 12px;
            }

            .reaction-left,
            .reaction-right {
                gap: 16px;
            }

            .count {
                font-size: 13px;
            }
        }

        .hide {
            display: none;
        }
    </style>

    {{-- comment component --}}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            line-height: 1.5;
            color: #292929;
        }

        .comment-trigger {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #1a8917;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .comments-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
        }

        .comments-container {
            position: fixed;
            background: white;
            z-index: 999;
            transition: transform 0.3s ease-out;
            display: flex;
            flex-direction: column;
        }

        /* Mobile styles */
        @media (max-width: 700px) {
            .comments-container {
                left: 0;
                right: 0;
                bottom: 0;
                height: 90vh;
                transform: translateY(100%);
                border-radius: 12px 12px 0 0;
            }

            .comments-container.active {
                transform: translateY(0);
            }
        }

        /* Desktop styles */
        @media (min-width: 701px) {
            .comments-container {
                top: 0;
                right: 0;
                width: 600px;
                height: 100vh;
                transform: translateX(100%);
            }

            .comments-container.active {
                transform: translateX(0);
            }
        }

        .comments-header {
            padding: 16px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comments-title {
            font-size: 20px;
            font-weight: 600;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            padding: 4px;
        }

        .comments-content {
            padding: 16px;
            flex-grow: 1;
            overflow-y: auto;
        }

        .comment {
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid #eee;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
        }

        .comment-meta {
            flex-grow: 1;
        }

        .comment-author {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .comment-time {
            font-size: 14px;
            color: #757575;
        }

        .comment-text {
            font-size: 16px;
            margin-bottom: 12px;
        }

        .reply {
            margin-left: 52px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #eee;
        }

        .comment-form {
            padding: 16px;
            border-top: 1px solid #eee;
        }

        .comment-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 12px;
            resize: vertical;
        }

        .submit-button {
            padding: 10px 20px;
            background: #1a8917;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .comment-actions {
            position: relative;
        }

        .comment-menu-button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 20px;
            padding: 4px;
        }

        .comment-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border: 1px solid #eee;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: none;
            z-index: 1000;
        }

        .comment-menu.active {
            display: block;
        }

        .comment-menu-item {
            padding: 8px 16px;
            cursor: pointer;
        }

        .comment-menu-item:hover {
            background: #f5f5f5;
        }

        .reply-button {
            border: 0;
            color: rgb(153, 153, 153);
            background-color: rgb(255, 255, 255);
            font-weight: 500;
        }
    </style>

</head>

<body>

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

    @include('Authenticated_pages.layouts.spinner')


    <div class="py-4"></div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-9 mb-lg-0">
                    <article>
                        @if (isset($blog->cover_photo))
                            <div class="post-slider mb-4">
                                <img style="max-height: 600px"
                                    src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                                    class="card-img-top" alt="post-thumb">
                            </div>
                        @endif

                        <h1 class="h2">{{ $blog->title }}</h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="{{ route('profile.other.show', $blog->user_id) }}" class="card-meta-author">
                                    @if ($blog->user->photo)
                                        <img src="{{ asset('uploads/' . $blog->user->photo) }}" alt="Author Image">
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
                                <i
                                    class="ti-calendar"></i>{{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('F') }}
                                {{ $blog->created_at->format('d') }}, {{ $blog->created_at->format('Y') }}
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    <li class="list-inline-item"><a
                                            href="{{ route('show.blogs', $blog->category_id) }}">{{ $blog->get_category($blog) }}</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div id="description-content" class="content  col-lg-12" style="padding:10px;">
                            {!! $blog->description !!}
                        </div>

                        <div id="image-modal" style="display: none;">
                            <span id="close-modal">&times;</span>
                            <img id="modal-image" src="" alt="Popup Image" />
                        </div>

                        <div class="tags">
                            @foreach ($blog->tags as $tag)
                                <span class="tag"><a>{{ $tag->name }}</a></span>
                            @endforeach
                        </div>
                    </article>
                </div>

                <div class="col-lg-12 justify-content-center">
                    @if (isset($comments))
                        <div class=" pt-5 ">
                            <div class="reaction-bar">

                                <div class="reaction-left">
                                    <button type="button" class="reaction-item {{ $is_liked ? '' : 'unliked' }}"
                                        data-blog-id="{{ $blog->id }}" id="clap-button">
                                        <div class="icon">


                                            <svg id="unliked_svg" widht="24" height="24"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-6 {{ $is_liked ? 'hide' : '' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                            </svg>

                                            <svg id="liked_svg" widht="24" height="24"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6 {{ $is_liked ? '' : 'hide' }}">
                                                <path
                                                    d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                            </svg>
                                        </div>
                                        <span class="count" id="clap-count">{{ $blog->like_count }}</span>
                                    </button>
                                </div>

                                <div class="reaction-right">

                                    <button type="button"
                                        class="reaction-item save {{ $is_saved ? '' : 'unsaved' }} "
                                        data-blog-id="{{ $blog->id }}" id="bookmark-button">
                                        <div class="icon">
                                            <svg id="saved" style="width: 40px; height:40px"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6 {{ $is_saved ? '' : 'hide' }}">
                                                <path fill-rule="evenodd"
                                                    d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg id="unsaved" style="width: 40px; height:40px"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="size-6 {{ $is_saved ? 'hide' : '' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                            </svg>
                                        </div>
                                        <span id="save_count_span"
                                            class="save-count col-1 pl-0 ">{{ $blog->save_count }}</span>
                                    </button>
                                    <button type="button" class="reaction-item">
                                        <div class="icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                                <polyline points="16 6 12 2 8 6" />
                                                <line x1="12" y1="2" x2="12" y2="15" />
                                            </svg>
                                        </div>
                                    </button>
                                    {{-- <button type="button" class="reaction-item">
                                <div class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="19" cy="12" r="1" />
                                        <circle cx="5" cy="12" r="1" />
                                    </svg>
                                </div>
                            </button> --}}
                                </div>
                            </div>
                            <button style="z-index: 500;" type="button" class="reaction-item comment-trigger">
                                <div class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    </svg>
                                </div>
                                <span class="count">{{ $blog->comment_count }}</span>
                            </button>
                            <div class="comments-overlay"></div>
                            <div class="comments-container">
                                <div class="comments-header">
                                    <h2 class="comments-title">Responses ({{ $blog->comment_count }})</h2>
                                    <button class="close-button" aria-label="Close comments">&times;</button>
                                </div>
                                <div class="comments-content">
                                    @foreach ($comments as $comment)
                                        @if (!isset($comment->parent_id))
                                            {{-- reply olmayan yorumlar --}}
                                            <div class="comment">
                                                <div class="comment-header">

                                                    @if ($comment->user->photo)
                                                        <img src="{{ asset('uploads/' . $comment->user->photo) }}"
                                                            alt="" class="avatar">
                                                    @else
                                                        <img style="width: 50px; height:50px; border-radius: 50%;"
                                                            src="/img/Default_pfp.jpg" alt="Author Image">
                                                    @endif
                                                    <div class="comment-meta">
                                                        <a href="{{ route('profile.other.show', $comment->user->id) }}"
                                                            style="color: black"
                                                            class="comment-author">{{ $comment->user->name }}</a>
                                                        <div class="comment-time">
                                                            {{ $comment->created_at->diffForHumans() }}</div>
                                                    </div>
                                                    @if ($comment->user->id == Auth::user()->id)
                                                        <div class="comment-actions">
                                                            <button class="comment-menu-button"
                                                                aria-label="Comment actions">&#8942;
                                                            </button>
                                                            <div class="comment-menu">
                                                                <div class="comment-menu-item" data-action="edit"
                                                                    onclick="editComment('{{ $comment->content }}',{{ $comment->id }})">
                                                                    Edit
                                                                </div>
                                                                <div class="comment-menu-item" data-action="delete"
                                                                    onclick="deleteComment({{ $blog->id }},{{ $comment->id }})">
                                                                    Delete
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="comment-text">
                                                    {{ $comment->content }}
                                                </div>
                                                <button class="reply-button"
                                                    onclick="makeReply({{ $comment->id }},{{ $blog->id }})">Reply
                                                </button>
                                                @if ($comment->replies()->count() > 0)
                                                    @foreach ($comment->replies as $reply)
                                                        @if ($reply->status != 0)
                                                            <div class="reply">
                                                                <div class="comment-header">
                                                                    @if ($reply->user->photo)
                                                                        <img src="{{ asset('uploads/' . $reply->user->photo) }}"
                                                                            alt="" class="avatar">
                                                                    @else
                                                                        <img style="width: 50px; height:50px; border-radius: 50%;"
                                                                            src="/img/Default_pfp.jpg"
                                                                            alt="Author Image">
                                                                    @endif
                                                                    <div class="comment-meta">
                                                                        <a href="{{ route('profile.other.show', $reply->user->id) }}"
                                                                            style="color: black"
                                                                            class="comment-author">
                                                                            {{ $reply->user->name }}</a>
                                                                        <div class="comment-time">
                                                                            {{ $reply->created_at->diffForHumans() }}
                                                                        </div>
                                                                    </div>
                                                                    @if ($reply->user->id == Auth::user()->id)
                                                                        <div class="comment-actions">
                                                                            <button class="comment-menu-button"
                                                                                aria-label="Comment actions">&#8942;
                                                                            </button>
                                                                            <div class="comment-menu">
                                                                                <div class="comment-menu-item"
                                                                                    data-action="edit"
                                                                                    onclick="editComment('{{ $reply->content }}',{{ $reply->id }})">
                                                                                    Edit
                                                                                </div>
                                                                                <div class="comment-menu-item"
                                                                                    data-action="delete"
                                                                                    onclick="deleteComment({{ $blog->id }},{{ $reply->id }})">
                                                                                    Delete
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div class="comment-text">
                                                                    {{-- <b
                                                                style="border-radius: 5px; color:rgb(63, 146, 0); padding:0; ">${{ $comment->user->name }}
                                                            </b> --}}{{ $reply->content }}
                                                                </div>
                                                                <button class="reply-button"
                                                                    onclick="makeReply({{ $reply->id }},{{ $blog->id }})">
                                                                    Reply
                                                                </button>
                                                            </div>
                                                        @endif
                                                        @if ($reply->replies()->count() > 0)
                                                            @include(
                                                                'Authenticated_pages.blogs.comments.child',
                                                                [
                                                                    'replies' => $reply->replies,
                                                                    'comment' => $reply,
                                                                ]
                                                            )
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <form class="comment-form" action="{{ route('comment.created') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <textarea name="comment" class="comment-input" placeholder="Write a comment..." rows="3"
                                        aria-label="Write a comment"></textarea>
                                    <button type="submit" class="submit-button">Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>


    @include('Authenticated_pages/layouts.footer')
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- highlight.js --}}
    <script src="{{ asset('highlight/') }}/highlight.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('code').forEach((block) => {
                block.style.borderRadius = '3px';
            });
            setTimeout(() => {
                hljs.highlightAll();
            }, 0);
        });
    </script>


    {{-- comment işlemleri --}}
    <script>
        async function makeReply(comment_id, blog_id) {

            const {
                value: text
            } = await Swal.fire({
                input: "textarea",
                inputLabel: "New Comment",
                inputPlaceholder: "Type your comment here...",
                inputAttributes: {
                    "aria-label": "Type your comment here"
                },
                showCancelButton: true
            });
            if (text) {
                $(document).ready(function() {
                    $.ajax({
                        url: "{{ route('comment.replied') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            blog_id: blog_id,
                            comment_id: comment_id,
                            reply: text
                        },
                        dataType: 'json',

                        success: function(response) {
                            if (response.success) {
                                window.location.reload();
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(xhr, status, error) {

                            alert(xhr.responseText); // Sunucudan gelen tam hata mesajı
                            alert("Status: " + xhr.status); // HTTP status kodu (örn. 404, 500)
                            alert("Error: " +
                                error); // jQuery tarafından sağlanan genel hata mesajı

                            // Kullanıcıya gösterilecek mesaj (opsiyonel)
                            alert('Bir hata oluştu: ' + error);
                        }
                    });
                });
            }
        };

        async function editComment(content, id) {
            const {
                value: text
            } = await Swal.fire({
                input: "textarea",
                inputLabel: "Edit Comment",
                inputValue: content,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                $(document).ready(function() {
                    $.ajax({
                        url: "{{ route('comment.edited') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            comment: text,
                            comment_id: id
                        },
                        dataType: 'json',

                        success: function(response) {
                            if (response.success) {
                                window.location.reload();
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(xhr, status, error) {

                            alert(xhr.responseText); // Sunucudan gelen tam hata mesajı
                            alert("Status: " + xhr.status); // HTTP status kodu (örn. 404, 500)
                            alert("Error: " +
                                error); // jQuery tarafından sağlanan genel hata mesajı

                            // Kullanıcıya gösterilecek mesaj (opsiyonel)
                            alert('Bir hata oluştu: ' + error);
                        }
                    });
                });
            }
        };

        function deleteComment(blog_id, comment_id) {
            $(document).ready(function() {
                $.ajax({
                    url: "{{ route('comment.deleted') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        blog_id: blog_id,
                        comment_id: comment_id
                    },
                    dataType: 'json',

                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            console.log(response);
                        }
                    },
                    error: function(xhr, status, error) {

                        alert(xhr.responseText); // Sunucudan gelen tam hata mesajı
                        alert("Status: " + xhr.status); // HTTP status kodu (örn. 404, 500)
                        alert("Error: " +
                            error); // jQuery tarafından sağlanan genel hata mesajı

                        // Kullanıcıya gösterilecek mesaj (opsiyonel)
                        alert('Bir hata oluştu: ' + error);
                    }
                });
            });
        }
    </script>

    {{-- like işlemi --}}
    <script>
        $(document).ready(function() {
            $('#clap-button').on('click', function(event) {
                event.preventDefault();
                var button = $(this);
                var liked_svg = document.getElementById('liked_svg');
                var unliked_svg = document.getElementById('unliked_svg');
                var likeCountSpan = document.getElementById('clap-count');
                var currentCount = parseInt(likeCountSpan.textContent);
                var blogId = button.data('blog-id');
                var isLike = button.hasClass('unliked') ? 1 : 0;

                $.ajax({
                    url: "{{ route('blog.liked') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        blog_id: blogId,
                        is_like: isLike
                    },
                    success: function(response) {
                        if (response.success) {
                            if (isLike) {
                                liked_svg.classList.remove('hide');
                                unliked_svg.classList.add('hide');
                                button.removeClass('unliked'); // jQuery metodu
                                likeCountSpan.textContent = currentCount +
                                    1; // text yerine textContent
                            } else {
                                liked_svg.classList.add('hide');
                                unliked_svg.classList.remove(
                                    'hide'); // classList doğru kullanımı
                                button.addClass('unliked'); // jQuery metodu
                                likeCountSpan.textContent = currentCount -
                                    1; // text yerine textContent
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                    }
                });
            });
        });
    </script>

    {{-- save işlemi --}}
    <script>
        $(document).ready(function() {
            $('.save').on('click', function(event) {
                event.preventDefault();
                var button = $(this);
                var saveCountSpan = document.getElementById('save_count_span');
                var currentCount = parseInt(saveCountSpan.textContent); // text yerine textContent
                var blogId = button.data('blog-id');
                var isSaved = button.hasClass('unsaved') ? 1 : 0;
                var saved_svg = document.getElementById('saved');
                var unsaved_svg = document.getElementById('unsaved');

                $.ajax({
                    url: "{{ route('blog.saved') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        blog_id: blogId,
                        is_saved: isSaved
                    },
                    success: function(response) {
                        if (response.success) {
                            if (isSaved) {
                                unsaved_svg.classList.add('hide');
                                saved_svg.classList.remove('hide');
                                button.removeClass('unsaved'); // jQuery ile sınıf kaldırma
                                saveCountSpan.textContent = currentCount +
                                    1; // text yerine textContent
                            } else {
                                saved_svg.classList.add('hide');
                                unsaved_svg.classList.remove('hide');
                                button.addClass('unsaved'); // jQuery ile sınıf ekleme
                                saveCountSpan.textContent = currentCount -
                                    1; // text yerine textContent
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                    }
                });
            });
        });
    </script>

    {{-- zoom modal --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const descriptionContent = document.getElementById("description-content");
            const modal = document.getElementById("image-modal");
            const modalImage = document.getElementById("modal-image");
            const closeModal = document.getElementById("close-modal");

            // Description içindeki img etiketlerine tıklama olayı ekle
            descriptionContent.querySelectorAll("img").forEach((img) => {
                img.style.cursor = "pointer"; // Tıklanabilir yap
                img.addEventListener("click", function() {
                    modalImage.src = img.src; // Modal içindeki resmi güncelle
                    modal.classList.add("show"); // Modal'ı aç
                    modal.style.display = "flex"; // Modal'ı görünür yap
                });
            });

            // Modal'ı kapat
            closeModal.addEventListener("click", function() {
                modal.classList.remove("show"); // Modal sınıfını kaldır
                setTimeout(() => {
                    modal.style.display = "none"; // Animasyon sonrası gizle
                }, 400); // Animasyon süresiyle uyumlu olmalı
            });

            // Modal arka plana tıklanırsa kapat
            modal.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.classList.remove("show");
                    setTimeout(() => {
                        modal.style.display = "none";
                    }, 400);
                }
            });
        });
    </script>

    {{-- comment component --}}
    <script>
        const trigger = document.querySelector('.comment-trigger');
        const container = document.querySelector('.comments-container');
        const overlay = document.querySelector('.comments-overlay');
        const closeButton = document.querySelector('.close-button');
        const form = document.querySelector('.comment-form');

        function openComments() {
            container.classList.add('active');
            overlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeComments() {
            container.classList.remove('active');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        }

        trigger.addEventListener('click', openComments);
        closeButton.addEventListener('click', closeComments);
        overlay.addEventListener('click', closeComments);

        /* form.addEventListener('submit', function(e) {
            const input = form.querySelector('.comment-input');

        }); */

        // Comment menu functionality
        document.querySelectorAll('.comment-menu-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.stopPropagation();
                const menu = this.nextElementSibling;
                menu.classList.toggle('active');

                // Close other open menus
                document.querySelectorAll('.comment-menu.active').forEach(openMenu => {
                    if (openMenu !== menu) {
                        openMenu.classList.remove('active');
                    }
                });
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function() {
            document.querySelectorAll('.comment-menu.active').forEach(menu => {
                menu.classList.remove('active');
            });
        });

        // Handle edit and delete actions
    </script>


</body>

</html>
