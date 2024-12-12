@foreach ($replies as $reply)
    @if ($reply->status != 0)
        {{-- <div class="media d-block mb-3 d-sm-flex" style="margin-left: calc(20px + {{ $i }}px)">
            <div class="d-inline-block mr-1 mb-2 mb-md-0" href="#">
                <img class="mr-1" src="{{ asset('style/reader/') }}/images/post/arrow.png" alt="">
                <a href="#!">
                    @if ($reply->user->photo)
                        <img style="width: 50px; height:50px; border-radius: 50%"
                            src="{{ asset('uploads/' . $reply->user->photo) }}" alt="Author Image">
                    @else
                        <img style="width: 50px; height:50px; border-radius: 50%;" src="/img/Default_pfp.jpg"
                            alt="Author Image">
                    @endif
                </a>
            </div>
            <div class="media-body">
                <div class="col-sm-12 row">
                    <a href="{{ route('profile.other.show', $reply->user_id) }}"
                        class="h4 d-inline-block mb-3 col-md-3 ">{{ $reply->user->name }}
                    </a>

                    <div class="bosluk col-md-6"></div>

                    @if (Auth::user()->id == $reply->user->id)
                        <div class="btn-group">
                            <button style="background-color: white; color:black; border-width:0px"
                                class="btn btn-danger dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                Edit
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item"
                                        onclick="editComment('{{ $reply->content }}',{{ $reply->id }})">Edit</a>
                                </li>

                                <hr class="dropdown-divider">

                                <li>
                                    <a class="dropdown-item"
                                        onclick="deleteComment({{ $blog->id }},{{ $reply->id }})">Delete</a>
                                </li>
                            </ul>
                        </div>
                    @endif




                </div>

                <p>{{ $reply->content }}</p>

                <span
                    class="text-black-800 mr-3 font-weight-600">{{ \Carbon\Carbon::parse($reply->created_at)->translatedFormat('F') }}
                    {{ $reply->created_at->format('d') }},
                    {{ $reply->created_at->format('Y') }} at
                    {{ \Carbon\Carbon::parse($reply->created_at)->format('H:i') }}
                </span>
                <a class="text-primary font-weight-600" href="#!"
                    onclick="makeReply({{ $reply->id }},{{ $blog->id }})">Reply</a>
            </div>
        </div> --}}
        <div class="reply">
            <div class="comment-header">
                @if ($reply->user->photo)
                    <img src="{{ asset('uploads/' . $reply->user->photo) }}" alt="" class="avatar">
                @else
                    <img style="width: 50px; height:50px; border-radius: 50%;" src="/img/Default_pfp.jpg"
                        alt="Author Image">
                @endif
                <div class="comment-meta">
                    <a href="{{route('profile.other.show',$reply->user->id)}}"  style="color: black"  class="comment-author">{{ $reply->user->name }}</a>
                    <div class="comment-time">{{ $reply->created_at->diffForHumans() }}</div>
                </div>
                @if ($reply->user->id == Auth::user()->id)
                    <div class="comment-actions">
                        <button class="comment-menu-button" aria-label="Comment actions">&#8942;</button>
                        <div class="comment-menu">
                            <div class="comment-menu-item" data-action="edit"
                                onclick="editComment('{{ $reply->content }}',{{ $reply->id }})">
                                Edit
                            </div>
                            <div class="comment-menu-item" data-action="delete"
                                onclick="deleteComment({{ $blog->id }},{{ $reply->id }})">
                                Delete
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="comment-text">
                <a href="{{route('profile.other.show',$comment->user->id)}}" style="border-radius: 5px; color:rgba(63, 146, 0); padding:0; ">@ {{ $comment->user->name }}
                </a>{{ $reply->content }}
            </div>
            <button class="reply-button" onclick="makeReply({{ $reply->id }},{{ $blog->id }})">Reply</button>

        </div>
    @endif


    @if (isset($reply->replies))
        @include('Normal_Kullanıcı.blogs.comments.child', [
            'replies' => $reply->replies,
            'comment' => $reply,
        ])
    @endif
@endforeach
