<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PostController extends Controller implements HasMiddleware

{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(): View
    {
        $posts = Post::query()
            ->latest()
            ->with('user', 'category', 'tags')
            ->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $post->load('user', 'category');
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
        Gate::authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostUpdateRequest $request): RedirectResponse
    {
        Gate::authorize('update', $post);
        $post->update($request->validated());

        return to_route('posts.show', compact('post'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return to_route('posts.index');
    }

}
