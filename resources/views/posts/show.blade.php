<x-layout>
    <div class="row g-5">
        <div class="col-md-8">
            <article class="blog-post">
                <div class="d-flex">
                    @can('owner', $post)
                        <a href="{{ route('posts.edit', compact('post')) }}" class="btn btn-sm btn-dark mx-2">Edit</a>
                        <form action="{{ route('posts.destroy', compact('post')) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-dark">Delete</button>
                        </form>
                    @endcan
                    <span
                        class="btn bg-{{ $post->status->color() }} btn-sm mx-2 rounded-pill text-white"
                    >{{ $post->status->label() }}</span>
                    <span class="my-1">{{ $post->category?->name }}</span>
                </div>
                <h2 class="display-5 link-body-emphasis mb-1">{{ $post->title }}</h2>
                <p class="blog-post-meta">{{ $post->created_at?->format('d M Y') }} by
                    <span>{{ $post->user->name }}</span></p>
                @auth
                <div class="d-flex">
                    @if(count($post->user->subscriptions))
                        <form action="{{ route('subscriptions.destroy', ['subscription' => $post->user->subscriptions[0]]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-secondary">Unsubscribe</button>
                        </form>
                    @else
                        <form action="{{ route('subscriptions.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="author_id" value="{{ $post->user->id }}">
                            <button class="btn btn-sm btn-dark">Subscribe</button>
                        </form>
                    @endif
                </div>
                @endauth
                @foreach($post->tags as $tag)
                    <a href="{{ route('posts.index', ['tag' => $tag->name]) }}">
                        <strong class="d-inline-block mb-2 text-primary-emphasis mx-1">#{{ $tag->name }}</strong></a>
                @endforeach

                <p>{{ $post->text }}</p>
            </article>
            @auth
                <x-comments.form :$post/>
            @endauth
            <div>
                <h3>Comments</h3>
                <x-comments.list :comments="$post->comments" :$post :margin="0"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Customize this section to tell your visitors a little bit about your publication,
                        writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <x-recent-posts/>

                <div class="p-4">
                    <h4 class="fst-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="#">March 2021</a></li>
                        <li><a href="#">February 2021</a></li>
                        <li><a href="#">January 2021</a></li>
                        <li><a href="#">December 2020</a></li>
                        <li><a href="#">November 2020</a></li>
                        <li><a href="#">October 2020</a></li>
                        <li><a href="#">September 2020</a></li>
                        <li><a href="#">August 2020</a></li>
                        <li><a href="#">July 2020</a></li>
                        <li><a href="#">June 2020</a></li>
                        <li><a href="#">May 2020</a></li>
                        <li><a href="#">April 2020</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-layout>


<script>
    function openForm(formId) {
        let forms = document.querySelectorAll('.commentForm')

        for (let i = 0; i < forms.length; i++) {
            forms[i].hidden = true
        }
        document.querySelector('#' + formId).hidden = false
    }
</script>
