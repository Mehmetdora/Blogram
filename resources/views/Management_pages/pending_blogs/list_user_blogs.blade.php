@extends('Management_pages.layouts.app')
@section('style')
    <style>


        .resim {


            display: flex;
            justify-content: center;
            /* Yatayda ortalama */
            align-items: center;
            /* Dikeyde ortalama */
            height: 100%;
            /* Div'in yüksekliği */
            width: 100%;
            /* Div'in genişliği */
            padding: 5px;
            /* Eşit kenar boşlukları */

        }

        .resim img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* Resmin boyutunu koruyarak oturtur */
        }
    </style>
@endsection
@section('content')

    <div class="pagetitle" style=" display:flex">
        <a href="{{ route('pending_blogs') }}" style="display: flex; border-color: black" class="btn col-sm-3">
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


            </div>

            <div id="search_list" class="row col-lg-12">
                @include('Public_pages.layouts._message')

                @if (@isset($blogs))
                    @foreach ($blogs as $blog)
                        <div class="col-lg-3 mb-3" style="background-color:whitesmoke; margin:5px; border-radius:7px; ">
                            <div class="post-entry-alt">
                                <a href=" {{ route('detail-pending_blog', $blog->id) }} " class="img-link">
                                    <div class="resim">
                                        <img style=" margin-top:5px;   border-radius:5px "
                                             src="{{ asset('blog_images/cover_photos/' . $blog->cover_photo) }}"
                                             alt="Image" class="img-fluid">
                                    </div>
                                </a>
                                <div class="excerpt">


                                    <h2><a href="{{ route('detail-pending_blog', $blog->id) }}"> {{ $blog->title }} </a>
                                    </h2>
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
                                                    href="{{ route('list-user-pending_blogs', $blog->user->id) }}">
                                            {{ $blog->get_blog_user($blog)->name }} </a></span>
                                        <span>&nbsp;-&nbsp; {{ $blog->created_at->diffForHumans() }} </span>
                                    </div>

                                    <p> {{ $blog->summery }} </p>
                                    <p><a href="{{ route('detail-pending_blog', $blog->id) }}" class="read-more">More
                                            Info</a></p>
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
                    url: "{{ route('search_pending_blog') }}",
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
