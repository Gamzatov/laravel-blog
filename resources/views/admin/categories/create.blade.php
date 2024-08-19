<x-admin.layout title="Categories">
    <form action="{{route('admin.categories.store')}}" method='post'>
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>
        <div class="form-group my-2">
            <button class="btn btn-dark mx-1">
                Create
            </button>
        </div>
    </form>
</x-admin.layout>
