@extends('Public_pages/layouts.app')
@section('style')
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
            <h3 class="display-3 font-weight-bold text-white">Users Blogs</h3>
            
        </div>
    </div>
    <!-- Header End -->

    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5">
                    <span class="px-2">Latest Blogs</span>
                </p>
                <h1 class="mb-4">Some Articles From Users</h1>
            </div>
            <div class="row pb-3 col-sm-12">
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 mb-4">
                        <div class="card border-0 shadow-sm mb-2">
                            <img class="card-img-top mb-2"  src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}" alt="" />
                            <div class="card-body bg-light text-center p-4">
                                <h4 class="">{{$blog->title}}</h4>
                                <div class="d-flex justify-content-center mb-3">
                                    <small class="mr-3"><i class="fa fa-user text-primary"></i> {{$blog->user->name}}</small>
                                    <small class="mr-3"><i class="fa fa-folder text-primary"></i> {{$blog->get_category($blog)}}</small>
                                    <small class="mr-3"><i class="fa fa-comments text-primary"></i> {{$blog->comment_count}}</small>
                                </div>
                                <p>
                                    {{  $blog->summery }}
                                </p>
                                <a href="{{route('blogs.show',$blog->id)}}" class="btn btn-primary px-4 mx-auto my-2">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-md-12 mb-4" style="margin-left:40%">
                    {{ $blogs->links() }}

                </div> --}}
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
@section('script')
@endsection
