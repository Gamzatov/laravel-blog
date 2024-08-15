<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        return view('posts.show', compact('post'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {

        $post = Post::query()->create($request->validated());
        return to_route('posts.index', compact('post'));
    }

    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostUpdateRequest $request): RedirectResponse
    {
        $post ->update($request->validated());

        return to_route('posts.show', compact('post'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return to_route('posts.index');
    }

}
