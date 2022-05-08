@extends('layouts.main')

@section('content')
    <main class="blog-post">
        <div class="container">
            <h1 class="edica-page-title aos-init aos-animate" data-aos="fade-up">{{ $post->title }}</h1>
            <p class="edica-blog-post-meta aos-init aos-animate" data-aos="fade-up"
               data-aos-delay="200">{{ $date->translatedFormat('F') }} {{ $date->day }}, {{ $date->year }}
                • {{ $date->format('H:i') }} • {{ $post->comments->count() }} Комментариев</p>
            <section class="blog-post-featured-img aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <img src="{{ asset('storage/' . $post->main_image) }}" alt="featured image" class="w-100">
            </section>
            <section class="post-content">
                <div class="row">
                    <div class="col-lg-9 mx-auto mb-5">
                        {!! $post->content !!}
                        @auth()
                        <form action="{{ route('post.like.store', $post->id) }}" method="post">
                            @csrf
                            <button class="border-0 bg-transparent" type="submit">

                                    @if(auth()->user()->likedPosts->contains($post))
                                        <span style="color: #ff4343"><b>{{ $post->liked_users_count }}</b></span>
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
                </div>

            </section>

            <section class="comment-list w-75 mx-auto mb-5">
                <h2 class="section-title mb-5" data-aos="fade-up">Комментарии <span
                        style="font-size: 20px; border-radius: 50%; background-color: #3ec0a0;">&nbsp;&nbsp;{{ $comments->count() }}&nbsp;&nbsp;</span>
                </h2>
                @foreach($comments as $comment)
                    <div class="card-footer card-comments mb-2" data-aos="fade-up">
                        <div class="comment-text">
                        <span class="username">
                          <b>{{ $comment->user->name }}</b>
                          <span style="font-size: 14px"
                                class="text-muted float-right">{{ $comment->dateAsCarbon->diffForHumans() }}</span>
                        </span><!-- /.username -->
                            <br>
                            <div class="mt-1" style="font-size: 14px">
                                {{ $comment->message }}
                            </div>
                        </div>
                        <!-- /.comment-text -->
                    </div>
                @endforeach
            </section>

            <!-- /.card-comment -->
        </div>
        </section>

        <div class="row">
            <div class="col-lg-9 mx-auto">
                @auth()
                    <section class="comment-section">
                        <h2 class="section-title mb-5 aos-init" data-aos="fade-up">Оставить комментарий</h2>
                        <form action="{{ route('post.comment.store', $post->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12 aos-init" data-aos="fade-up">
                                    <label for="comment" class="sr-only">Ваш комментарий</label>
                                    <textarea name="message" id="comment" class="form-control"
                                              placeholder="Ваш комментарий"
                                              rows="10"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 aos-init" data-aos="fade-up">
                                    <input type="submit" value="Отправить" class="btn btn-warning">
                                </div>
                            </div>
                        </form>
                    </section>
                @endauth
                @if($relatedPosts->count() > 0)
                    <section class="related-posts">
                        <h2 class="section-title mb-4 aos-init" data-aos="fade-up">Читайте также</h2>
                        <div class="row">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4 aos-init" data-aos="fade-right" data-aos-delay="100">
                                    <img src="{{ asset('storage/' . $relatedPost->preview_image) }}" alt="related post"
                                         class="post-thumbnail">
                                    <p class="post-category">{{ $relatedPost->category->title }}</p>
                                    <a class="text-decoration-none" href="{{ route('post.show', $relatedPost->id) }}">
                                        <h5
                                            class="post-title">{{ $relatedPost->title }}</h5></a>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
        </div>
        </div>
    </main>
@endsection


