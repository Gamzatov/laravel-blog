<div class="nav-scroller py-1 mb-1 mt-3">
    <nav class="nav nav-underline justify-content-between">
        @foreach($categories as $category)
            <a class="nav-item nav-link link-body-emphasis"
               href="#">{{$category->name}}</a>
        @endforeach
    </nav>
</div>
