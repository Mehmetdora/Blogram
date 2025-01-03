<div>

    <div class="search-container justify-content-center" style="margin: 0; left:25%; width:50%">
        <input type="text" style="width:100%" wire:model.live="search" class="search-inputt" placeholder="Search User...">
    </div>

    @if (strlen($search) > 0)
        @if ($users->count() > 0)
            <div class="container">
                <div class="row no-gutters">
                    @foreach ($users as $user)
                        <div class="col-lg-4 col-sm-6 author-block">
                            <div class="author-card text-center">

                                <img class="author-image" src="{{ asset('uploads/' . $user->photo) }}">

                                <h3 class="mb-2"><a href="{{ route('profile.other.show', $user->id) }}"
                                        class="post-title">{{ $user->name }}</a>
                                </h3>
                                <p class="mb-3">{{ $user->skill }}</p>

                                <a class="post-count" href="#"><i class="ti-pencil-alt mr-2"></i><span
                                        class="text-primary">{{ $user->blogs->count() }}</span> Posts by
                                    this author</a>
                                <ul class="list-inline social-icons">

                                    <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a>
                                    </li>

                                    <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a>
                                    </li>

                                    <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a>
                                    </li>

                                    <li class="list-inline-item"><a href="#"><i class="ti-link"></i></a></li>

                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <div class="row no-gutters">
            @if (isset($users_all))
                <div class="container">
                    <div class="row no-gutters">
                        @foreach ($users_all as $user)
                            <div class="col-lg-4 col-sm-6 author-block">
                                <div class="author-card text-center">

                                    <img class="author-image" src="{{ asset('uploads/' . $user->photo) }}">

                                    <h3 class="mb-2"><a href="{{ route('profile.other.show', $user->id) }}"
                                            class="post-title">{{ $user->name }}</a>
                                    </h3>
                                    <p class="mb-3">{{ $user->skill }}</p>

                                    <a class="post-count" href="#"><i class="ti-pencil-alt mr-2"></i><span
                                            class="text-primary">{{ $user->blogs->count() }}</span> Posts by
                                        this author</a>
                                    <ul class="list-inline social-icons">

                                        <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a>
                                        </li>

                                        <li class="list-inline-item"><a href="#"><i
                                                    class="ti-twitter-alt"></i></a>
                                        </li>

                                        <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a>
                                        </li>

                                        <li class="list-inline-item"><a href="#"><i class="ti-link"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif

</div>


