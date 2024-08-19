<x-layout title="Admin Panel" offCategories>
    <div class="row h-100">
        <div class="col-2">
            <a class="btn btn-dark" href="{{route('admin.categories.index')}}">Categories</a>
        </div>
        <div class="col-10">
            <h1>{{$title}}</h1>
            {{$slot}}
        </div>
    </div>
</x-layout>
