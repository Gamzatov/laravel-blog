<x-layout>
    <h1>
        Create Post
    </h1>
    <form action="{{route('posts.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Text</label>
            <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="">
            <button class="btn btn-dark">
                Create
            </button>
        </div>
    </form>
</x-layout>
