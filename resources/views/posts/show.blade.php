@php use App\Enums\Post\PostStatusEnum; @endphp
<x-layout>
    <div class="row g-5">
        <div class="col-md-8">

            <article class="blog-post">
                @can('owner', $post)
                    <a href="{{route('posts.edit', compact('post'))}}" class="btn btn-dark">Edit</a>
                    <button class="btn btn-sn btn-danger" form="deletePost">Delete</button>
                @endcan
                <button
                    class="btn btn-{{($post->status)->color()}} text-white rounded-pill btn-sm  mx-2">{{($post -> status)->label()}}</button>
                    <span class="category_name my-1" href="#">{{$post->category?->name}}</span>
                <form id="deletePost" method="post" action="{{route('posts.destroy', compact('post'))}}">
                    @csrf
                    @method('delete')
                </form>

                <h2 class="display-5 link-body-emphasis mb-1">{{$post->title}}</h2>
                <p class="blog-post-meta">{{$post->created_at}}
                    <span href="#">{{$post->user->name}}</span>

                </p>
                <p>{{$post->description}}</p>
                <p>{{$post->text}}</p>
            </article>
            <nav class="blog-pagination" aria-label="Pagination">
                <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
                <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
            </nav>
        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-body-tertiary rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Customize this section to tell your visitors a little bit about your publication,
                        writers, content, or something else entirely. Totally up to you.</p>
                </div>

                <div>
                    <h4 class="fst-italic">Recent posts</h4>
                    <ul class="list-unstyled">
                        <li>
                            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                               href="#">
                                <svg class="bd-placeholder-img" width="100%" height="96"
                                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <rect width="100%" height="100%" fill="#777"/>
                                </svg>
                                <div class="col-lg-8">
                                    <h6 class="mb-0">Example blog post title</h6>
                                    <small class="text-body-secondary">January 15, 2024</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                               href="#">
                                <svg class="bd-placeholder-img" width="100%" height="96"
                                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <rect width="100%" height="100%" fill="#777"/>
                                </svg>
                                <div class="col-lg-8">
                                    <h6 class="mb-0">This is another blog post title</h6>
                                    <small class="text-body-secondary">January 14, 2024</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                               href="#">
                                <svg class="bd-placeholder-img" width="100%" height="96"
                                     xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                     preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <rect width="100%" height="100%" fill="#777"/>
                                </svg>
                                <div class="col-lg-8">
                                    <h6 class="mb-0">Longer blog post title: This one has multiple lines!</h6>
                                    <small class="text-body-secondary">January 13, 2024</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layout>









