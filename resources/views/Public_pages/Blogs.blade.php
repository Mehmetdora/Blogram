@extends('Public_pages/layouts.app')
@section('style')
@endsection
@section('content')
    <!-- Blog Start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="mb-4">
                    <h3 class="h2 mb-4">Latest Blogs
                    </h3>
                </div>
                <div class="col-lg-10">



                    @foreach ($blogs as $blog)
                        <article class="card mb-4">
                            <div class="row card-body">
                                @if (isset($blog->cover_photo))
                                    <div class="col-md-4 mb-4 mb-md-0">
                                        <div class="post-slider slider-sm">
                                            <img src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}"
                                                class="card-img" alt="post-thumb" style="height:200px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-8">
                                    <h3 class="h4 mb-3"><a class="post-title"
                                            href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{ route('login') }}" class="card-meta-author">
                                                <img src="{{ asset('uploads/' . $blog->user->photo) }}"
                                                    alt="{{ $blog->user->name }}">
                                                <span>{{ $blog->user->name }}</span>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>{{ $blog->min_to_read }} min. to read
                                        </li>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                @if (count($blog->tags) != 0)
                                                    @foreach ($blog->tags as $tag)
                                                        <li class="list-inline-item"><a
                                                                href="{{ route('login') }}">{{ $tag->name }}</a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                    </ul>
                                    <p>{{ $blog->summery }}</p>
                                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary">Read
                                        More</a>
                                </div>
                            </div>
                        </article>
                    @endforeach


                </div>
            </div>
        </div>
    </section>
    <!-- Blog End -->
@endsection
@section('script')
@endsection
