@extends('layouts.master')

@section('header')
    <style>
        article {
            background: white;
            width: 100%;
            height: 100%;
            margin: 0;
        }

        .container-fluid {
            padding: 0;
        }

        .article-background-pattern:before,
        .article-background-pattern:after {
            content: '';
            display: table;
        }

        div.article-background-pattern {
            width: 100%;
            height: 1em;
            margin: 0;
            padding: 0;
            display: block;
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .row {
            margin: 0;
            width: 100%;
        }

        .card {
            background: white;
            padding: 0 1em;
            border-radius: 0;
            border: none;
            margin: 0;
            height: 100%;
        }

        .card .card-block {
            border-radius: 0;
            border: none;
            padding: 0;
            margin: 0;
        }

        .article-title {
            color: #607d8b;
            margin: 0;
            line-height: 3em;
            vertical-align: middle;
            padding: 0;
            display: block;
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            background-image: linear-gradient(
                white 80%,
                rgba(255, 255, 255, 0)
            );
        }

        .article-title a {
            color: inherit;
            text-decoration: none;
        }

        ul li {
            margin: 1em 0;
            background: white;

        }

        p.card-footer {
            background: none;
            border: none;
        }

        p.card-footer.card-text {
            padding-left: 0;
            padding-right: 0;
        }

        .label.label-pill.label-default {
            border: 1px solid #607d8b;
            background: none;
            color: #607d8b;
        }

        .text-fixed-width a {
            font-family: "Source Code Pro", sans-serif monospace;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">


        @foreach ( $articles as $article )

                <article class="item">
                    <div class="article-background-pattern"
                         style='background-image: {!! $article->header_image_path !!}'></div>

                    <div class="card">
                        <div class="card-block">


                            <h3 class="article-title"><a href="{{ route('individual_article_path', $article->article_id) }}">{{ $article->title }}</a>

                                <small class="pull-right text-fixed-width"><span class="label label-pill label-default"><a
                                            href="{{ route('individual_article_path', $article->article_id) }}">{{ $article->article_id }}</a></span></small>
                            </h3>

                            <div class="article-body">
                                <p class="text-justify">{{ $article->body }}</p>
                            </div>
                        </div>

                        <p class="card-text card-footer">
                            <small class="text-muted">
                                <i class="fa fa-fw fa-tags"></i>
                                @foreach ( $article->tags as $tag )
                                <a href="{{ route('individual_tag_path', $tag->name) }}"><span class="label label-pill label-default">{{ $tag->name }}</span></a>
                                @endforeach
                            </small>
                                <span class="pull-right"><small class="text-muted"><i
                                            class="fa fa-fw fa-clock-o"></i>
                                        {{ $article->published_at->diffForHumans() }}
                                    </small></span>
                        </p>
                    </div>
                </article>
        @endforeach
            </div>

    <div class="row">
        {!! $articles->render() !!}
    </div>

@endsection

@section('footer')
    <script src="/js/sticky.js"></script>
    <script>
        $('.article-background-patter').Stickyfill();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.10/vue.min.js"></script>
    <script>

    </script>
@endsection