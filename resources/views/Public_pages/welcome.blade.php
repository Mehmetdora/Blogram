@extends('Public_pages/layouts.app')
@section('style')
@endsection

@section('content')
    <section class="section-sm">
        <div class="container">
            <div class="content-wrapper"> <!-- <-- EKLEDİM -->

                <div class="row align-items-center justify-content-center">

                    <div class="alert col-8 justify-content-center">
                        @include('Public_pages.layouts._message')
                    </div>
                    <div class="col-lg-5 col-md-6 order-2 order-md-1">
                        <div class="pr-lg-4 pr-0">
                            <h2 class="mb-3">Open to Learning, Ready to Share </h2>
                            <label style="font-weight:bolder">Welcome!</label>
                            <br><br>

                            This platform is a source of knowledge where everyone open to learning and sharing comes
                            together.
                            Students and eager learners can share blogs based on their interests, bringing their knowledge
                            and
                            experiences to a community here. Whether you write about a current topic or offer tips from your
                            area of
                            expertise, this platform is your space to share.
                            <br><br>
                            You can read other users' posts, share your thoughts by commenting, and broaden your perspective
                            with
                            different viewpoints. Join now and take the first step on your journey of knowledge!
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 mb-4 mb-md-0 order-1 order-md-2">
                        <img class="img-fluid w-100" src="{{ asset(path: 'img/library2.webp') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Header End -->
@endsection
@section('script')
@endsection
