<div>
    <h4 class="fst-italic">Recent posts</h4>
    <ul class="list-unstyled">
        @foreach($posts as $post)
        <li>
            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
               href="{{ route('posts.show', compact('post')) }}">
                <img src="{{ asset('storage/' . $post->image) }}" width="100%" height="96" alt="">

                <div class="col-lg-8">
                    <h6 class="mb-0">{{ $post->title }}</h6>
                    <small class="text-body-secondary">{{ $post->created_at?->format('d F, Y') }}</small>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</div>
