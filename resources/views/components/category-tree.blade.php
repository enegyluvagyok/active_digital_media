<div class="card">
    <div class="card-body">
        <a href="{{route('guest.home')}}"> All</a>
        <ul>
            @foreach($categories as $category)
            @if($category->parent_id === null)
            <li>
                <a href="{{route('guest.home', ['category' => $category->category_id])}}"> {{ $category->category->title }}</a>
                <ul>
                    @foreach($categories as $child)
                    @if($child->parent_id === $category->id)
                    <li> <a href="{{route('guest.home', ['category' => $child->category_id])}}"> {{ $child->category->title }}</li></a>
                    @endif
                    @endforeach
                </ul>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>