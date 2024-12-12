<div>

    <div style="position: relative;">
        <input style="width: 100%" type="text" wire:model.live="search_category" id="searchInput" class="search-input"
            placeholder="Search on categories">
        <span class="search-icon">🔍</span>
    </div>
    @if (strlen($search_category) > 0)

        <ul class="list-unstyled widget-list">
            @if (isset($result_categories))
                @foreach ($result_categories as $category)
                    <li><a href="{{ route('show.blogs', $category->id) }}" class="d-flex">{{ $category->name }} <small
                                class="ml-auto">({{ \App\Models\Blog::where('category_id', $category->id)->where('status', 1)->count() }})</small></a>
                    </li>
                @endforeach
            @else
                <a class="dropdown-item" href="#">No Result</a>
            @endif

        </ul>

    @else
        <ul class="list-unstyled widget-list" style="width:100% ; ">
            @if (isset($all_categories))
                @foreach ($all_categories as $category)
                    <li ><a href="{{ route('show.blogs', $category->id) }}" class="d-flex">{{ $category->name }} <small
                                class="ml-auto">({{ \App\Models\Blog::where('category_id', $category->id)->where('status', 1)->count() }})</small></a>
                    </li>
                @endforeach
            @else
                <a class="dropdown-item" href="#">No Result</a>
            @endif


        </ul>

    @endif
</div>
