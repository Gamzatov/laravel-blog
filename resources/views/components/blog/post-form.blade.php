<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Title</label>
    <input type="text" class="form-control" id="exampleFormControlInput1"
           name="title" value="{{ old('title', $post->title ?? '') }}">
    @error('title')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
              name="description">{{ old('description', $post->description ?? '') }}</textarea>
    @error('description')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Text</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
              name="text">{{ old('text', $post->text ?? '') }}</textarea>
    @error('text')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="">Image</label>
    <input type="file" name="image" class="form-control" id="inputImage" onchange="showImage()">
    @if($post->image ?? false)
        <img alt="" src="{{ asset('storage/' . $post->image) }}"
             width="300" id="newProductImage">
    @else
        <img alt="" width="300" id="newProductImage">
    @endif
    @error('image')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
<x-category-select :post="$post ?? null"/>
<x-tag-select :post="$post ?? null"/>
<script>
    function showImage() {
        let selectedFile = event.target.files[0];
        let reader = new FileReader();

        let imgtag = document.getElementById("newProductImage");

        reader.onload = function (event) {
            imgtag.src = event.target.result;
        };

        reader.readAsDataURL(selectedFile);
    }
</script>
