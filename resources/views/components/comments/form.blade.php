<form action="{{ route('comments.store') }}" method="post"
@isset($comment) hidden id="commentForm-{{ $comment->id }}" class="commentForm" @endisset>
    @csrf
    <h3>Write comment</h3>
    <div class="row">
        <input type="hidden" value="{{ $post->id }}" name="post_id">
        @isset($comment)
            <input type="hidden" value="{{ $comment->id }}" name="comment_id">
        @endisset
        <div class="col-md-6">
             <textarea
                 name="text"
                 class="form-control col-md-6" id="" cols="10" rows="5"></textarea>
        </div>
    </div>
    <button class="btn btn-sm btn-dark my-2">Send</button>
</form>
