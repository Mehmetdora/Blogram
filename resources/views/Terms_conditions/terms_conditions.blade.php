<!DOCTYPE html>
<html lang="en-us">
@if($logined)
    <head>
        <meta charset="utf-8">


        <!-- mobile responsive meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="This is meta description">
        <meta name="author" content="Themefisher">
        <meta name="generator" content="Hugo 0.74.3"/>

        <!-- plugins -->

        <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="{{ asset('style/') }}/reader/plugins/slick/slick.css">

        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="{{ asset('style/') }}/reader/css/style.css" media="screen">

        <!--Favicon-->
        <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
        <link rel="icon" href="images/favicon.png" type="image/x-icon">

        <meta property="og:title" content="Reader | Hugo Personal Blog Template"/>
        <meta property="og:description" content="This is meta description"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content=""/>
        <meta property="og:updated_time" content="2020-03-15T15:40:24+06:00"/>

        <title>{{ $site_setting->site_name }}</title>
        @include('Authenticated_pages.layouts.header_style')

    </head>
@else
    <head>
        <meta charset="utf-8"/>
        <title>Blogram</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="keywords"/>
        <meta content="" name="description"/>

        <!-- Favicon -->
        <link href="{{ asset('front') }}/img/favicon.ico" rel="icon"/>

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com"/>
        <link
            href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap"
            rel="stylesheet"
        />

        <!-- Font Awesome -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"/>

        <!-- Flaticon Font -->
        <link href="{{ asset('front') }}/lib/flaticon/font/flaticon.css" rel="stylesheet"/>

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('front') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"/>
        <link href="{{ asset('front') }}/lib/lightbox/css/lightbox.min.css" rel="stylesheet"/>

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('front') }}/css/style.css" rel="stylesheet"/>

        @yield('style')
    </head>
@endif


<body>
<!-- navigation -->
@if($logined)
    @include('Authenticated_pages.layouts.header')
@else
    @include('Public_pages/layouts._header')
@endif
<!-- /navigation -->


@if($logined)
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
                  stroke="#040306" stroke-miterlimit="10"/>
            <path class="path"
                  d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z"/>
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z"
                  stroke="#040306" stroke-miterlimit="10"/>
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
@endif


@if(!$logined)
    <div class="container text-center" style="margin-top: 50px;">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <h1 class="mb-4">Our Terms & Consditions</h1>
            </div>
        </div>
    </div>
@endif
<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="content">

                    <h4>Şartların Kabulü</h4>
                    <p>Bu blog sitesine ("Blogram") erişerek veya kullanarak, bu Hüküm ve Koşulları kabul etmiş
                        olursunuz. Eğer bu koşulları kabul etmiyorsanız, lütfen siteyi kullanmayı bırakınız.</p>
                    <h4>Şartlarda Değişiklik</h4>
                    <p>Blog üzerinde yayınlanan bu Hüküm ve Koşullar zaman zaman güncellenebilir. Güncellemeler, sitede
                        yayınlandığı anda geçerli olur. Değişikliklerden haberdar olmak için bu sayfayı düzenli olarak
                        kontrol etmek sizin sorumluluğunuzdadır.</p>

                    <h4> İçerik Kullanımı</h4>
                    <p>- Blogda yer alan tüm içerik yalnızca bilgi amaçlıdır. İçeriklerin doğruluğu, eksiksizliği veya
                        faydalılığı garanti edilmez.</p>
                    <p>- Blogdaki içerikleri kişisel kullanım için paylaşabilirsiniz. Ancak içeriklerin ticari amaçla
                        kopyalanması, çoğaltılması veya dağıtılması yasaktır.</p>

                    <h4> Kullanıcı Davranışları</h4>
                    <p>Kullanıcı olarak şunları yapmamayı kabul edersiniz:</p>
                    <ol>
                        <li>Zararlı, hakaret içeren veya yasa dışı içerik göndermek,</li>
                        <li>Site işleyişini bozacak faaliyetlerde bulunmak,</li>
                        <li>Sitenin herhangi bir bölümüne veya sistemine izinsiz erişim sağlamaya çalışmak.</li>
                    </ol>

                    <h4>Yorumlar ve Kullanıcı Tarafından Üretilen İçerik</h4>
                    <p>- Bloga yorum bıraktığınızda veya herhangi bir içerik gönderdiğinizde, bu içeriği blogda
                        kullanma, çoğaltma, düzenleme ve yayınlama hakkını bize vermiş olursunuz.</p>
                    <p>- Herhangi bir yorum veya içeriği önceden bildirimde bulunmaksızın düzenleme veya kaldırma
                        hakkımız saklıdır.</p>

                    <h4>Fikri Mülkiyet Hakları</h4>
                    <p>- Blogdaki içerik, tasarım ve işlevselliğe ilişkin tüm fikri mülkiyet hakları "Blogram" 'a
                        aittir.</p>
                    <p>- İzin alınmadan blogun logoları, markaları veya diğer fikri mülkiyet unsurları kullanılamaz.</p>

                    <h4> Üçüncü Taraf Bağlantıları</h4>
                    <p>Blogda yer alan üçüncü taraf bağlantıları, sizin kolaylığınız için sağlanmıştır. Bu
                        bağlantılardaki içerik veya politikalarla ilgili hiçbir sorumluluk kabul edilmez.</p>

                    <h4>Gizlilik Politikası</h4>
                    <p>Blogun kullanımı aynı zamanda [Gizlilik Politikası] kapsamında yürütülür. Verilerinizin nasıl
                        toplandığı, kullanıldığı ve korunduğu hakkında bilgi için Gizlilik Politikamızı
                        inceleyebilirsiniz.</p>

                    <h4>Sorumluluğun Sınırlandırılması</h4>
                    <p>- Blogun kullanımından doğabilecek doğrudan veya dolaylı zararlar için hiçbir sorumluluk kabul
                        edilmez.</p>
                    <p>- Blogun her zaman kesintisiz, hatasız veya güvenli bir şekilde çalışacağı garanti edilmez.</p>

                    <h4>Erişim Kısıtlaması</h4>
                    <p>Herhangi bir gerekçeyle, önceden bildirimde bulunmaksızın siteye erişiminizi kısıtlama veya
                        sonlandırma hakkını saklı tutarız.</p>

                    <h4>Uygulanacak Hukuk</h4>
                    <p>Bu Hüküm ve Koşullar, Türkiye Cumhuriyeti Devleti yasalarına göre yönetilir ve yorumlanır.</p>

                    <h4>İletişim</h4>
                    <p>Bu Hüküm ve Koşullar hakkında sorularınız varsa, bizimle iletişime geçebilirsiniz:</p>
                    <ul>
                        <li>E-posta: mehmetdora333@gmail.com</li>
                        <li>Telefon: (+90) 537 824 4539</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

@if($logined)
    @include('Authenticated_pages/layouts.footer')
@else
    @include('Public_pages/layouts._footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"
    ><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('front') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="{{ asset('front') }}/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="{{ asset('front') }}/lib/lightbox/js/lightbox.min.js"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('front') }}/js/main.js"></script>
@endif


</html>
