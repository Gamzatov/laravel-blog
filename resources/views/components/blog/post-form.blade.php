<div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Title</label>
    <input type="text" value="{{old('title', $post->title ?? '')}}" name="title" class="form-control"
           id="exampleFormControlInput1"
           placeholder="Title">
    @error('title')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">
               {{old('Description', $post->description ?? '')}}
            </textarea>
    @error('description')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Text</label>
    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3">
                   {{old('Text', $post->text ?? '')}}
            </textarea>
    @error('text')
    <div class="alert alert-danger my-1">{{ $message }}</div>
    @enderror
</div>
