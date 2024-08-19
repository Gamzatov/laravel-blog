<x-admin.layout title="Categories">
    <form action="{{route('admin.categories.update', compact('category'))}}" method='post'>

        @csrf
        @method('put')
        <div class="form-group">
            <label for="">Name</label>
            <input class="form-control" type="text" name="name" value="{{$category->name}}">
        </div>
        <div class="form-group my-2">
            <button class="btn btn-dark mx-1">
                Save
            </button>
            <form action="{{route('admin.categories.destroy', compact('category'))}}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-dark mx-1">
                    Delete
                </button>
            </form>
        </div>
    </form>
</x-admin.layout>
