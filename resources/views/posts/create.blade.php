<x-layout>

    <h1>
        Create Post
    </h1>
    <form action="{{route('posts.store')}}" method="post">
        @csrf
        <x-blog.post-form />
        <div class="">
            <button class="btn btn-dark">
                Create
            </button>
        </div>
    </form>
</x-layout>
