<div>

    <div class="input-livewire" >
        <input  type="text" wire:model.live="search" id="searchInput" class="search-input"
            placeholder="🔎 Search">
    </div>
    @if (strlen($search) > 0)
        <div id="searchResults" class="search-results" width:60%; margin-left:25%; margin-top:80px">


            <div class="category">
                <h5 class="category-title">BLOGS</h5>
                @forelse ($blogs as $blog)
                    <a href="{{route('blogs.show',$blog->id)}}" style="color: inherit;" class="result-item">
                        <span class="result-icon">📚</span>
                        <span >{{ $blog->title }}</span>
                    </a>
                @empty
                    <div class="result-item">
                        <span>No Result</span>
                    </div>
                @endforelse
            </div>

            <div class="category">
                <h5 class="category-title">PEOPLE</h5>
                @forelse ($people as $person)
                    <a href="{{ route('profile.other.show', $person->id) }}" style="color: inherit;" class="result-item">
                        <img width="30px" style="border-radius: 50%" src="{{asset('uploads/')}}/{{$person->photo}}" class="result-icon" alt="">
                        <span>{{ $person->name }}</span>
                    </a>
                @empty
                    <div class="result-item">
                        <span>No Result</span>
                    </div>
                @endforelse
            </div>

            <div class="category">
                <h5 class="category-title">CATEGORİES</h5>

                @forelse ($categories as $category)
                    <a href="{{ route('show.blogs', $category->id) }}" style="color: inherit;" class="result-item">
                        <img width="20px" src="{{asset('site_settings/site_icons/category.png')}}" class="result-icon" alt="">
                        <span>{{ $category->name }}</span>
                    </a>
                @empty
                    <div class="result-item">
                        <span>No Result</span>
                    </div>
                @endforelse
            </div>


        </div>
    @endif
</div>
