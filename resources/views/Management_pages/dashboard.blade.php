@extends('Management_pages.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <div class="section dashboard row">

        <div class=" col-lg-4">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">Total Users</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h3>{{$user_count}}</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class=" col-lg-4">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">Pending Blog Posts</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h3>{{$pending_blogs_count}}</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class=" col-lg-4">
            <div class="card info-card sales-card">

                <div class="card-body">
                    <h5 class="card-title">Approved Blog Posts</span></h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person"></i>
                        </div>
                        <div class="ps-3">
                            <h3>{{$blog_count_approved}}</h3>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('script')
@endsection
