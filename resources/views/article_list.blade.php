@extends('index')

@section('content')
    <div class="article-list">
        @foreach ($articles as $article)
            <article class="article-list-item">
                <h2 class="article-title">
                    <a href="{{ route('showArticle', ['sign' => $article->sign]) }}">{{ $article->title }}</a>
                </h2>
                <div class="article-detail">
                    <span class="article-date">{{ $article->created_at->toDateString() }} by daryl</span> · 
                    <span class="article-hot">{{ $article->comments->count() }} Comments</span>
                </div>
                <p class="article-main">{{ $article->content }}</p>
            </article>
        @endforeach
    </div>
@endsection