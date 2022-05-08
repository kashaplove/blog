@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Блог</h1>
            <section class="featured-posts-section">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                <img src="{{ 'storage/' . $post->preview_image }}" alt="blog post">
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="blog-post-category">{{ $post->category->title }}</p>
                                @auth()
                                <form action="{{ route('post.like.store', $post->id) }}" method="post">
                                    @csrf

                                    <button class="border-0 bg-transparent pl-1" type="submit">
                                            @if(auth()->user()->likedPosts->contains($post))
                                                <span
                                                    style="color: #ff4343"><b>{{ $post->liked_users_count }}</b></span>
                                                <i style="color: #ff4343" class="fas fa-heart"></i>
                                            @else
                                                <span><b>{{ $post->liked_users_count }}</b></span>
                                                <i class="far fa-heart"></i>
                                            @endif
                                    </button>
                                </form>
                                @endauth
                                @guest()
                                    <div>
                                        <span><b>{{ $post->liked_users_count }}</b></span>
                                        <i class="far fa-heart"></i>
                                    </div>
                                @endguest
                            </div>
                            <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{ $post->title }}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="mx-auto mb-5" style="margin-top: -80px">
                        {{ $posts->links() }}
                    </div>
                </div>
            </section>
            <div class="row mt-5">
                <div class="col-md-8 mt-5">
                    <section>
                        <div class="row blog-post-row">
                            @foreach($randomPosts as $randomPost)
                                <div class="col-md-6 blog-post" data-aos="fade-up">
                                    <div class="blog-post-thumbnail-wrapper">
                                        <img src="{{ 'storage/' . $randomPost->preview_image }}" alt="blog post">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p class="blog-post-category">{{ $randomPost->category->title }}</p>
                                        @auth()
                                            <form action="{{ route('post.like.store', $randomPost->id) }}"
                                                  method="post">
                                                @csrf
                                                <span>{{ $post->liked_users_count }}</span>
                                                <button class="border-0 bg-transparent" type="submit">

                                                    @if(auth()->user()->likedPosts->contains($randomPost))
                                                        <i style="color: #ff4343" class="fas fa-heart"></i>
                                                    @else
                                                        <i class="far fa-heart"></i>
                                                    @endif

                                                </button>
                                            </form>
                                        @endauth
                                        @guest()
                                            <div>
                                                <span><b>{{ $post->liked_users_count }}</b></span>
                                                <i class="far fa-heart"></i>
                                            </div>
                                        @endguest
                                    </div>
                                    <a href="{{ route('post.show', $randomPost->id) }}" class="blog-post-permalink">
                                        <h6 class="blog-post-title">{{ $randomPost->title }}</h6>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
                <div class="col-md-4 sidebar" data-aos="fade-left">
                    <div class="widget widget-post-list">
                        <h5 class="widget-title">Популярное</h5>
                        <ul class="post-list">
                            @foreach($likedPosts as $likedPost)
                                <li class="post">
                                    <a href="{{ route('post.show', $likedPost->id) }}" class="post-permalink media">
                                        <img src="{{ 'storage/' . $likedPost->preview_image }}" alt="blog post">
                                        <div class="media-body">
                                            <h6 class="post-title">{{ $likedPost->title }}</h6>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget">
                        <h5 class="widget-title">Categories</h5>
                        <img src="{{ asset('assets/images/blog_widget_categories.jpg') }}" alt="categories"
                             class="w-100">
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection


