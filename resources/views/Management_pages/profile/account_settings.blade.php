@extends('Management_pages.layouts.app')
@section('style')
@endsection
@section('content')
    <section class="section">
        <div class="row">

            <div class="col-lg-9" style="margin-left: 20%">
                @include('Public_pages.layouts._message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Account Settings</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" action="{{route('UpdateAccountSetting')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="col-12">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ $getUser->name }}" name="name"
                                       required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="text" readonly value="{{ $getUser->email }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Profile</label>
                                <input type="file" class="form-control" name="profile_pic">
                                @if ($user->photo)
                                    <img src=" {{ asset('uploads/' . $user->photo) }} "
                                         style="width: 36px; height: 36px; object-fit: cover;" class="rounded-circle">
                                @else
                                    <img src="/img/Default_pfp.jpg"
                                         style="width: 36px; height: 36px; object-fit: cover;"
                                         class="rounded-circle">
                                @endif
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Settings</button>
                            </div>
                        </form><!-- Vertical Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
