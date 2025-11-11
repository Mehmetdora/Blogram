<!-- Navbar Start -->
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="{{ route('welcome') }}">
            <img class="img-fluid" width="100px"
                src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}" alt="Blogram" />
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}"><b>Home</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blogs') }}"><b>Blogs</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}"><b>About</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}"><b>Contact</b></a>
                </li>
            </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">

            <a href="{{ url('login') }}" class="px-4 btn btn-dark">Login</a>
            <a href="{{ url('register') }}" class="btn btn-dark px-4" style="margin-left: 10px">Register</a>
            <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse"
                data-target="#navigation">
                <i class="ti-menu"></i>
            </button>
        </div>
    </nav>
</div>
<!-- Navbar End -->
