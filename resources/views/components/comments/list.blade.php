<div style="margin-left: {{ $margin }}px">
    @foreach($comments as $comment)
        <div id="comment-{{ $comment->id }}">
            <div class="d-flex justify-content-between">
                <div>
                    <b>{{ $comment->user->name }}</b>
                </div>
                @can('owner', $comment)
                    <div>
                        <button class="btn btn-sm btn-secondary"
                                type="button"
                                onclick="editComment('{{ $comment->id }}', '{{ route('comments.update', compact('comment')) }}')">
                                Edit
                        </button>
                        <button class="btn btn-sm btn-secondary"
                                type="button"
                                onclick="deleteComment('{{ route('comments.destroy', compact('comment')) }}', '{{ $comment->id }}')">
                            X
                        </button>
                    </div>
                @endcan
            </div>
            <p>{{ $comment->created_at->diffForHumans() }}</p>
            <div id="comment-text-wrapper-{{ $comment->id }}">
                <p id="comment-text-{{ $comment->id }}">{{ $comment->text }}</p>
            </div>
            @auth
                <span onclick="openForm('commentForm-{{ $comment->id }}')"
                      style="cursor: pointer">Reply</span>
                <x-comments.form :$post :$comment/>
            @endauth
            @if($comment->comments)
                <x-comments.list :comments="$comment->comments" :$post :margin="$margin + 40"/>
            @endif
        </div>
    @endforeach
</div>
<script>
    function deleteComment(route, commentId) {
        sendDeleteRequest(route)
            .then((json) => {
                if (json.status === 'success') {
                    document.querySelector(`#comment-${commentId}`).remove()
                }
            })
            .catch(error => error);
    }

    function sendDeleteRequest(route) {
        return fetch(route, {
            headers: {
                "X-CSRF-Token": '{{ csrf_token() }}',
                "Content-Type": "application/json"
            },
            method: 'DELETE',
        }).then(response => response.json())
    }

    function editComment(commentId, route) {
        let commentDiv = document.querySelector(`#comment-text-${commentId}`)
        let text = commentDiv.innerHTML
        commentDiv.hidden = true
        let textArea = document.createElement('textarea')
        textArea.classList = "form-control"
        textArea.id = 'text-area-' + commentId
        textArea.value = text
        document.querySelector(`#comment-text-wrapper-${commentId}`).append(textArea)
        let button = document.createElement('div')
        button.innerHTML = `<button class="btn btn-secondary btn-sm" onclick="updateComment('${commentId}', '${route}')">SAVE</button>`
        document.querySelector(`#comment-text-wrapper-${commentId}`).append(button)
    }

    function updateComment(commentId, route) {
        let text = document.querySelector(`#text-area-${commentId}`).value

        fetch(route, {
            headers: {
                "X-CSRF-Token": '{{ csrf_token() }}',
                "Content-Type": "application/json"
            },
            method: 'PUT',
            body: JSON.stringify({
                text
            })
        }).then(response => response.json())
            .then((json) => {
                if (json.status === 'success') {
                    document.querySelector(`#text-area-${commentId}`).remove()
                    document.querySelector(`#comment-text-${commentId}`).innerHTML = text
                    document.querySelector(`#comment-text-${commentId}`).hidden = false
                }
            })
    }
</script>
