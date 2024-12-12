@extends('Kayıtsız_Görüntülemeler/layouts.app')
@section('style')
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
            <h3 class="display-3 font-weight-bold text-white">Gallery</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0"><a class="text-white" href="">Home</a></p>
                <p class="m-0 px-2">/</p>
                <p class="m-0">Gallery</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Gallery Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5">
                    <span class="px-2">Our Gallery</span>
                </p>
                <h1 class="mb-4">Our Users Gallery</h1>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-2">
                    <ul class="list-inline mb-4" id="portfolio-flters">
                        <li class="btn btn-outline-primary m-1 active" data-filter="*">
                            All
                        </li>
                        @foreach ($categories as $category)
                            <li class="btn btn-outline-primary m-1 " data-filter=".{{ $category->name }}">
                                {{ $category->name }}
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="row portfolio-container">

                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item {{ $blog->get_category($blog) }}">
                        <div class="position-relative overflow-hidden mb-2">
                            <img class="img-fluid w-100" style="height: 300px" src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}"
                                alt="" />
                            <div class="portfolio-btn bg-primary d-flex align-items-center justify-content-center">
                                <a href="{{ route('blogs.show', $blog->id) }}">
                                    <img class="img-fluid " style="height: 200px"
                                        src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}" alt="" />
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Gallery End -->
@endsection
@section('script')
@endsection
