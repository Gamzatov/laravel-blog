<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostGetRequest;
use App\Http\Requests\Post\PostStoreRequest;
use App\Http\Requests\Post\PostUpdateRequest;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    public function index(PostGetRequest $request): View
    {
        $posts = Post::query()
            ->latest()
            ->with('user', 'category', 'tags')
            ->filterByCategory($request->category)
            ->filterByTag($request->tag)
            ->search($request->search)
            ->paginate(8)
            ->withQueryString();

        return view('posts.index', compact(['posts']));
    }

    public function show(Post $post): View
    {
        $post->load(['user',
            'user.subscriptions' => function ($query) {
                $query->when(auth()->id(), function ($query) {
                    $query->where('reader_id', auth()->id());
                });
            }, 'category', 'tags', 'comments.user', 'comments.comments']);

        return view('posts.show', compact('post'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $post = Post::query()->create($request->validated());

            if ($image = $request->file('image')) {
                $fileName = $image->getClientOriginalName();
                $path = 'posts/' . $post->id . '/';
                Storage::putFileAs($path, $image, $fileName);
                $post->update(['image' => $path . $image->getClientOriginalName()]);
            }

            $post->tags()->attach($request->tags);
        } catch (Exception $e) {
            DB::rollBack();
            Log::alert($e->getMessage());
            return to_route('posts.index');
        }

        DB::commit();

        return to_route('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        Gate::authorize('owner', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, PostUpdateRequest $request): RedirectResponse
    {
        Gate::authorize('owner', $post);
        $post->update($request->validated());
        $post->tags()->sync($request->tags);

        if ($image = $request->file('image')) {
            $fileName = $image->getClientOriginalName();
            $path = 'posts/' . $post->id . '/';
            Storage::putFileAs($path, $image, $fileName);
            $post->update(['image' => $path . $image->getClientOriginalName()]);
        }

        return to_route('posts.show', compact('post'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('owner', $post);
        $post->delete();
        return to_route('posts.index');
    }
}
