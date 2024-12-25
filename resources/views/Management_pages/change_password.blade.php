@extends('Management_pages.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Change Password</h1>
    </div><!-- End Page Title -->

    <div class="section">
        <div class="row">

            <div class="col-lg-12">
                @include('Public_pages.layouts._message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{ route('changed_password') }}" method="post">
                            @csrf

                            <div class="col-12">
                                <label for="inputNanme4" class="form-label">Old Password</label>
                                <input type="password" class="form-control" name="old_password" required
                                       id="inputNanme4">
                            </div>
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" required
                                       id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm_password" required class="form-control"
                                       id="inputPassword4">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
