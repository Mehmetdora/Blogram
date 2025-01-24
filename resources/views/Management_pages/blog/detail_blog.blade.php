@extends('Management_pages.layouts.app')
@section('style')
    <link type="text/css" rel="stylesheet" href="{{asset('Jodit/jodit.min.css')}}"/>
    <script type="text/javascript" src="/Jodit/jodit.min.js"></script>
    <link rel="stylesheet" href="{{ asset('highlight/') }}/styles/monokai.css">


    <style>
        .cover-image {
            max-width: 100%;
        }

        .post-container {
            position: relative;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 80%;
            margin-top: 5%;
            margin-left: 10%;

            margin-bottom: 50px;
        }

        .post-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .post-author {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .post-author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .author-info {
            font-size: 14px;
        }

        .author-info .author-name {
            color: #4c4c4c;
            font-weight: bold;
        }

        .author-info .post-date {
            color: #9a9a9a;
        }


        .post-desc {
            width: 100%;
            /* Div genişliğini belirleyin */
            overflow: hidden;
            /* İçeriğin dışarı taşmasını engeller */
            word-wrap: break-word;
            /* Uzun kelimelerin taşmasını önler */
        }

        .post-desc img {
            max-width: 100%;
            /* Resmin div'den taşmasını önler */
            height: auto;
            /* Oranını koruyarak yeniden boyutlandırır */
        }
    </style>
@endsection
@section('content')

    <div class="pagetitle" style=" display:flex">
        <a href="@if (url()->previous() == route('list-user-blog',$blog->user->id)) {{ route('list-user-blog',$blog->user->id) }}
            @else {{ route('blogs_comments') }} @endif "
           style="display: flex; border-color: black"
           class="btn col-sm-3">


            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                <path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/>
            </svg>
            <h1>Back Blogs</h1>
        </a>

        <div class="a col-sm-4"></div>

        <a href="{{ route('edit-blog', $blog->id) }}" class="btn btn-primary col-sm-2" style="margin-right: 3%">
            Edit Blog
        </a>

        <a onclick="delete_blog({{ $blog->id }})" class="btn btn-danger col-sm-2">
            Delete Blog
        </a>


    </div><!-- End Page Title -->

    <div class="container col-lg-12" style="position: relative;">

        @include('Public_pages.layouts._message')

        <div class="post-container">
            @if (isset($blog))
                @if (isset($blog->cover_photo))
                <div class="cover">
                    <img class="cover-image" src="{{ asset('blog_images/cover_photos/') }}/{{ $blog->cover_photo }}"
                         alt="">
                </div>
                @endif

                <div class="baslık">
                    <div class="post-title">{{ $blog->title }}</div>
                </div>
                <div class="post-author">
                    @if ($blog->user->photo)
                        <img src="{{ asset('uploads/' . $blog->user->photo) }}" alt="Author Image">
                    @else
                        <img src="/img/Default_pfp.jpg" alt="Author Image">
                    @endif
                    <div class="author-info">
                        <a class="author-name"
                           href="{{ route('list-user-blog', $blog->user->id) }}">{{ $blog->user->name }}</a>
                        <div class="post-date">{{$blog->min_to_read}} min to read • {{ $blog->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <div class="post-interactions">
                    <div class="interaction">
                        <a id="unlike_button">
                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 22 22" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                            </svg>
                        </a>
                        <span class="like-count" style="margin-right: 20px">{{ $blog->like_count }}</span>

                        <a id="comment_button">
                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 22 22" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/>
                            </svg>
                        </a>
                        <span class="comment-count">{{ $blog->comment_count }}</span>

                    </div>
                </div>
                <div class="post-desc">
                    {!! $blog->description !!}
                </div>

            @endif
        </div>

        @if (count($comments) != 0)
            <h2 style="margin-left: 250px">Comments</h2>
            <table class="table" style="width: 90%; margin-left:5%">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">User Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Comment</th>
                    <th scope="col">date</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row"> {{ $comment->user->id }} </th>
                        <td>{{ $comment->user->name }}</td>
                        <td style="max-width: 400px">{{ $comment->content }}</td>
                        <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                        <td>
                            <button type="button" class="btn btn-danger"
                                    onclick="delete_comment({{ $comment->id }})">Delete
                            </button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        @endif
    </div>

@endsection

@section('script')
    {{-- highlight.js --}}
    <script src="{{ asset('highlight/') }}/highlight.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('code').forEach((block) => {
                block.style.borderRadius = '3px';
            });
            setTimeout(() => {
                hljs.highlightAll();
            }, 0);
        });
    </script>

    <script>
        function delete_comment(id) {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlemi geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Silme işlemi burada yapılabilir
                    $(document).ready(function () {
                        var comment_id = id;

                        $.ajax({
                            url: "{{ route('delete-comment') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                comment_id: comment_id
                            },
                            success: function (response) {
                                if (response.success) {

                                    Swal.fire(
                                        'Silindi!',
                                        'Yorum başarıyla silindi.',
                                        'success'
                                    ).then(() => {
                                        window.location.reload()
                                    });
                                } else {
                                    alert('AJAX HATASI');
                                }
                            },
                            error: function (xhr) {
                                alert(xhr.responseText)
                            }
                        });

                    });
                } else {
                    // Vazgeçildiğinde yapılacak işlemler (gerekirse)


                    Swal.fire(
                        'İptal Edildi',
                        'Silme işlemi iptal edildi.',
                        'error'
                    );
                }
            });
        }

        function delete_blog(id) {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Bu işlemi geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Evet, sil!',
                cancelButtonText: 'Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Silme işlemi burada yapılabilir
                    $(document).ready(function () {
                        var blog_id = id;

                        $.ajax({
                            url: "{{ route('delete-blog') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                blog_id: blog_id
                            },
                            success: function (response) {
                                if (response.success) {

                                    Swal.fire(
                                        'Silindi!',
                                        'Blog başarıyla silindi.',
                                        'success'
                                    ).then(() => {
                                        // Route ile yönlendirme işlemi
                                        window.location.href =
                                            "{{ route('blogs_comments') }}";
                                    });
                                } else {
                                    alert('AJAX HATASI');
                                }
                            },
                            error: function (xhr) {
                                alert(xhr.responseText)
                            }
                        });

                    });
                } else {
                    // Vazgeçildiğinde yapılacak işlemler (gerekirse)


                    Swal.fire(
                        'İptal Edildi',
                        'Silme işlemi iptal edildi.',
                        'error'
                    );
                }
            });
        }
    </script>
@endsection
