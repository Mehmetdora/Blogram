<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">


    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-name" content="reader" />
    <meta name="description" content="Share your new experiences with other people." />
    <meta name="author" content="Mehmet Dora" />

    <!-- plugins -->

    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <meta property="og:title" content="Blogram" />
    <meta property="og:description" content="Share your new experiences with other people." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('welcome') }}" />

    <title>{{ $site_setting->site_name }}</title>
    @include('Authenticated_pages.layouts.header_style')

</head>


<body>
    <!-- navigation -->
    @if ($logined)
        @include('Authenticated_pages.layouts.header')
    @else
        @include('Public_pages/layouts._header')
    @endif
    <!-- /navigation -->


    <div class="banner text-center" style="margin-top: 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <h1 class="mb-4">Our Terms & Consditions</h1>
                </div>
            </div>
        </div>

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
    <section class="section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="content">

                        <h4>Acceptance of Terms</h4>
                        <p>By accessing or using this blog ("Blogram"), you agree to these Terms and Conditions. If you
                            do not agree with these terms, please refrain from using the site.</p>

                        <h4>Changes to Terms</h4>
                        <p>These Terms and Conditions may be updated from time to time. Updates become effective as soon
                            as they are posted on the site. It is your responsibility to regularly check this page for
                            any changes.</p>

                        <h4>Use of Content</h4>
                        <p>- All content on the blog is for informational purposes only. Accuracy, completeness, or
                            usefulness of the content is not guaranteed.</p>
                        <p>- You may share content from the blog for personal use. However, copying, reproducing, or
                            distributing content for commercial purposes is prohibited.</p>

                        <h4>User Conduct</h4>
                        <p>As a user, you agree not to:</p>
                        <ol>
                            <li>Submit harmful, offensive, or illegal content,</li>
                            <li>Engage in activities that disrupt the operation of the site,</li>
                            <li>Attempt unauthorized access to any part of the site or its systems.</li>
                        </ol>

                        <h4>Comments and User-Generated Content</h4>
                        <p>- By leaving comments or submitting content to the blog, you grant us the right to use,
                            reproduce, edit, and publish that content on the blog.</p>
                        <p>- We reserve the right to edit or remove any comments or content without prior notice.</p>

                        <h4>Intellectual Property Rights</h4>
                        <p>- All intellectual property rights related to the blog’s content, design, and functionality
                            belong to "Blogram".</p>
                        <p>- Logos, trademarks, or other intellectual property of the blog may not be used without
                            permission.</p>

                        <h4>Third-Party Links</h4>
                        <p>Third-party links on the blog are provided for your convenience. We do not accept any
                            responsibility for the content or policies of these external sites.</p>

                        <h4>Privacy Policy</h4>
                        <p>Use of the blog is also governed by our <a href="#">Privacy Policy</a>. You can review
                            it to learn how your data is collected, used, and protected.</p>

                        <h4>Limitation of Liability</h4>
                        <p>- We are not responsible for any direct or indirect damages arising from the use of the blog.
                        </p>
                        <p>- We do not guarantee that the blog will always operate uninterrupted, error-free, or secure.
                        </p>

                        <h4>Access Restriction</h4>
                        <p>We reserve the right to restrict or terminate your access to the site at any time, without
                            prior notice, for any reason.</p>

                        <h4>Governing Law</h4>
                        <p>These Terms and Conditions are governed by and interpreted according to the laws of the
                            Republic of Turkey.</p>

                        <h4>Contact</h4>
                        <p>If you have any questions regarding these Terms and Conditions, you can contact us at:</p>
                        <ul>
                            <li>Email: mehmetdora333@gmail.com</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>



    @if ($logined)
        @include('Authenticated_pages/layouts.footer')
    @else
        @include('Public_pages/layouts._footer')
    @endif

    <!-- JavaScript Libraries -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('front') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('front') }}/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('front') }}/lib/lightbox/js/lightbox.min.js"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('front') }}/js/main.js"></script>


</html>
