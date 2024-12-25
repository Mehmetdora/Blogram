<!-- Navbar Start -->
<div class="container-fluid bg-light position-relative shadow">
    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
        <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px">
            <a href="{{ route('welcome') }}"> <img
                    src="{{ asset('site_settings/site_logo/') }}/{{ $site_setting->logo_url }}" alt="Logo"
                    class="logo-img">
            </a>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav font-weight-bold mx-auto py-0">
                <a href="{{ route('welcome') }}"
                    class="nav-item nav-link @if ($title == 'welcome') active @endif">Home</a>
                <a href="{{ route('blogs') }}"
                    class="nav-item nav-link @if ($title == 'blogs') active @endif">Blogs</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link @if ($title == 'about') active @endif">About</a>
                {{-- <a href="{{route('teams')}}" class="nav-item nav-link @if ($title == 'teams') active @endif">Teams</a>
                <a href="{{route('gallery')}}" class="nav-item nav-link @if ($title == 'gallery') active @endif">Gallery</a> --}}
                <a href="{{ route('contact') }}"
                    class="nav-item nav-link @if ($title == 'contact') active @endif">Contact</a>

            </div>
            <a href="{{ url('login') }}" class="btn btn-primary px-4">Login</a>
            <a href="{{ url('register') }}" class="btn btn-primary px-4" style="margin-left: 10px">Register</a>
        </div>
    </nav>
</div>
<!-- Navbar End -->
