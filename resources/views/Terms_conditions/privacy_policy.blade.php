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
    @endif <!-- /navigation -->

    <div class="banner text-center" style="margin-top: 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto">
                    <h1 class="mb-4">Our Privacy & Policy</h1>
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

                        <h4>Information We Collect</h4>
                        <p>When you visit our blog, we may collect the following types of information:</p>
                        <ul>
                            <li><strong>Personal Information:</strong> Information you voluntarily provide, such as your
                                name and email address (e.g., when leaving a comment or filling out a contact form).
                            </li>
                            <li><strong>Automatically Collected Information:</strong> Technical details such as IP
                                address, browser type, pages visited, device information, and cookies.</li>
                        </ul>

                        <h4>Use of Information</h4>
                        <p>The collected information may be used for purposes including:</p>
                        <ul>
                            <li>Providing you with a better user experience,</li>
                            <li>Sending relevant content, updates, or announcements,</li>
                            <li>Analyzing and improving the blog’s performance,</li>
                            <li>Detecting and preventing security breaches.</li>
                        </ul>

                        <h4>Cookies</h4>
                        <p>Our blog may use cookies to enhance your experience. Cookies may be used for:</p>
                        <ul>
                            <li>Remembering your site preferences,</li>
                            <li>Analyzing visitor traffic,</li>
                            <li>Providing more personalized content.</li>
                        </ul>
                        <p>You can adjust your cookie settings or disable cookies entirely via your browser. Please note
                            that some features may not function properly if cookies are disabled.</p>

                        <h4>Information Sharing</h4>
                        <p>Your personal information will not be shared with third parties, except in the following
                            cases:</p>
                        <ul>
                            <li>To comply with legal obligations,</li>
                            <li>To ensure user safety or prevent illegal activities,</li>
                            <li>For the use of third-party tools (e.g., Google Analytics) to provide analytics and
                                performance services.</li>
                        </ul>
                        <p>These third-party services are subject to their own privacy policies.</p>

                        <h4>Data Protection</h4>
                        <p>We take the security of your personal information seriously. Appropriate technical and
                            administrative measures are implemented to protect your data from unauthorized access, loss,
                            misuse, or alteration.</p>

                        <h4>Third-Party Links</h4>
                        <p>Our blog may include links to third-party websites. We are not responsible for the privacy
                            practices of these sites. Please review the privacy policy of each site you visit.</p>

                        <h4>User Rights</h4>
                        <p>You have the following rights regarding your personal data:</p>
                        <ul>
                            <li>To know what information is collected,</li>
                            <li>To request updates or corrections to your information,</li>
                            <li>To request the deletion of your information (as allowed by law),</li>
                            <li>To restrict or object to the processing of your data.</li>
                        </ul>
                        <p>To exercise these rights, you can contact us using the details below.</p>

                        <h4>Children’s Privacy</h4>
                        <p>Our blog is not intended for children under the age of 13. If we discover that we have
                            collected information from a child under 13, we will delete it immediately.</p>

                        <h4>Policy Changes</h4>
                        <p>This Privacy Policy may be updated from time to time. Significant changes will be
                            communicated via this page or other methods.</p>

                        <h4>Contact</h4>
                        <p>If you have any questions regarding this Privacy Policy, please contact us at:</p>
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


</html>
