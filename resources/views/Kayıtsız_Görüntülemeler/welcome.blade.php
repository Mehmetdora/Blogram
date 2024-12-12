@extends('Kayıtsız_Görüntülemeler/layouts.app')
@section('style')
@endsection
@section('content')
    <!-- Header Start -->


    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
        <div class="row align-items-center px-3">
            <div class="col-lg-6 mt-5 text-center text-lg-left">
                <div class="alert col-8 justify-content-center">
                    @include('Kayıtsız_Görüntülemeler.layouts._message')
                </div>
                <h4 class="text-white mb-4 mt-5 mt-lg-0">Interest-Based Knowledge Sharing</h4>
                <h1 class="display-3 font-weight-bold text-white">
                    Open to Learning, Ready to Share! </h1>
                <p class="text-white mb-4">
                    <label style="font-weight:bolder">Welcome!</label>
                    <br><br>

                    This platform is a source of knowledge where everyone open to learning and sharing comes together.
                    Students and eager learners can share blogs based on their interests, bringing their knowledge and
                    experiences to a community here. Whether you write about a current topic or offer tips from your area of
                    expertise, this platform is your space to share.
                    <br><br>
                    You can read other users' posts, share your thoughts by commenting, and broaden your perspective with
                    different viewpoints. Join now and take the first step on your journey of knowledge!
                </p>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <img class="img-fluid mt-5"  src="{{ asset('img/library2.png') }}" alt="" />
            </div>
        </div>
    </div>
    <!-- Header End -->

@endsection
@section('script')
@endsection
