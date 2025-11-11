@extends('Public_pages/layouts.app')
@section('style')
@endsection
@section('content')
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-5 mb-lg-0" src="{{ asset('img/about.jpg') }}" alt="" />
                </div>
                <div class="col-lg-7">
                    <p class="section-title pr-5">
                        <span class="pr-2">Learn About Us</span>
                    </p>
                    <h1 class="mb-4">Who am I ?</h1>
                    <p>
                        Hello, I'm Mehmet. My purpose in creating this site is to use my knowledge to develop a product
                        while also providing a space for others who, like me, are in the learning phase. Here, they can fill
                        in gaps in their knowledge through articles written by more experienced individuals, ask questions
                        if needed, and share with others.
                    </p>

                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
@section('script')
@endsection
