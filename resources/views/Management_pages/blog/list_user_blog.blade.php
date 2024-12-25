@extends('Management_pages.layouts.app')
@section('style')
    <style>
        .create-btn {
            border-width: 2px;
            border-color: black;
            background-color: whitesmoke;
        }

        .create-btn:hover {
            background-color: rgb(63, 162, 248);
            color: white;
        }
    </style>
@endsection
@section('content')

    <div class="pagetitle" style=" display:flex">
        <a href="{{ route('blogs_comments') }}" style="display: flex; border-color: black" class="btn col-sm-3">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                <path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/>
            </svg>
            <h1>Back Blogs</h1>
        </a>
    </div>

    <section class="section">
        <div class="container">

            <div class="row mb-4">
                <div class="col-sm-11" style="display: flex; max-height:50px">
                    <input id="search" class="form-control me-2 " type="search"
                           placeholder="Search by id, title, description..." data-user-id="{{$blogs_owner->id}}"
                           onfocus="this.value=''" aria-label="Search">
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-sm-3">
                    <h2 class="posts-entry-title">Blogs by {{ $blogs_owner->name }} </h2>
                </div>

                <div class="search col-sm-6"></div>

                <div class="col-sm-3">
                    <a class="btn create-btn" href=" {{ route('add-blog') }} ">
                        Create Blog
                    </a>
                </div>
            </div>

            <div id="search_list" class="row col-lg-12">
                @include('Public_pages.layouts._message')

                @if (@isset($blogs))
                    @foreach ($blogs as $blog)
                        <div class="col-lg-3 mb-3" style="background-color:whitesmoke; margin:5px; border-radius:7px; ">
                            <div class="post-entry-alt">
                                <a href=" {{ route('detail-blog', $blog->id) }} " class="img-link"><img
                                            style="height: 200px; margin-top:10px;"
                                            src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}"
                                            alt="Image"
                                            class="img-fluid"></a>
                                <div class="excerpt">


                                    <h2><a href="{{ route('detail-blog', $blog->id) }}"> {{ $blog->title }} </a></h2>
                                    <div class="post-meta align-items-center text-left clearfix">
                                        <figure class="author-figure mb-0 me-3 float-start">
                                            @if ($blog->user->photo)
                                                <img src="{{ asset('uploads/' . $blog->user->photo) }}"
                                                     class="img-fluid"
                                                     alt="Author Image">
                                            @else
                                                <img src="/img/Default_pfp.jpg" class="img-fluid" alt="Author Image">
                                            @endif
                                        </figure>

                                        <span class="d-inline-block mt-1">By <a
                                                    href="{{ route('list-user-blog', $blog->user->id) }}">
                                                {{ $blog->user->name }} </a></span>
                                        <span>&nbsp;-&nbsp; {{ $blog->created_at->diffForHumans() }} </span>
                                    </div>

                                    <p> {{ $blog->summery }} </p>
                                    <p><a href="{{ route('detail-blog', $blog->id) }}" class="read-more">More Info</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
            @if (@isset($blogs))
                <div class="d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                var query = $(this).val();
                var user_id = $(this).data('user-id');
                $.ajax({
                    url: "{{ route('search_blog') }}",
                    type: "GET",
                    data: {
                        'search': query,
                        'user_id': user_id
                    },
                    success: function (data) {
                        $('#search_list').html(data);
                    }
                });
                //end of ajax call
            });
        });
    </script>
@endsection
