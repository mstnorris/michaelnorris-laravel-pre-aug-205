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
            z-index: 50;
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

        .results {
            position: relative;
            top:0;
            left:0;
            width: 100%;
            background: white;
            z-index: 100;
        }

        .tt-menu {
            border: 1px solid #eceff1;
            text-align: left;
            position: relative;
            left:0;
            top:0;
            width: 100vw;
            z-index: 50;
        }

        .tt-suggestion {
            padding: 20px 10px;
            background: white;
            border-bottom: 1px solid #eceff1;
        }

        .tt-cursor {
            background: #eceff1;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">

                <div class="results">
                    <article v-repeat="article: articles" class="item">
                        <div class="article-background-pattern"
                             style='background-image: @{{ article.header_image_path }}'></div>

                        <div class="card">
                            <div class="card-block">


                                <h3 class="article-title"><a
                                        href="/@{{ article.article_id }}">@{{ article.title }}</a>

                                    <small class="pull-right text-fixed-width"><span class="label label-pill label-default"><a
                                                href="/@{{ article.article_id }}">@{{ article.article_id }}</a></span>
                                    </small>
                                </h3>

                                <div class="article-body">
                                    <p class="text-justify">@{{ article.body }}</p>
                                </div>
                            </div>
                        </div>

                        {{--<p v-html="article._highlightResult.title.value"></p>--}}
                        {{--<h4 v-html="article._highlightResult.published_at.value"></h4>--}}

                    </article>
                </div>

        </div>


        @foreach ( $articles as $article )
            <div class="row">
                <article class="item">
                    <div class="article-background-pattern"
                         style='background-image: {!! $article->header_image_path !!}'></div>

                    <div class="card">
                        <div class="card-block">


                            <h3 class="article-title"><a
                                    href="{{ route('individual_article_path', $article->article_id) }}">{{ $article->title }}</a>

                                <small class="pull-right text-fixed-width"><span class="label label-pill label-default"><a
                                            href="{{ route('individual_article_path', $article->article_id) }}">{{ $article->article_id }}</a></span>
                                </small>
                            </h3>

                            <div class="article-body">
                                <p class="text-justify">{{ $article->body }}</p>
                            </div>
                        </div>

                        <p class="card-text card-footer">
                            <small class="text-muted">
                                <i class="fa fa-fw fa-tags"></i>
                                @foreach ( $article->tags as $tag )
                                    <a href="{{ route('individual_tag_path', $tag->name) }}"><span
                                            class="label label-pill label-default">{{ $tag->name }}</span></a>
                                @endforeach
                            </small>
                                <span class="pull-right"><small class="text-muted"><i
                                            class="fa fa-fw fa-clock-o"></i>
                                        {{ $article->published_at->diffForHumans() }}
                                    </small></span>
                        </p>
                    </div>
                </article>
            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.12/vue.min.js"></script>
    <script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.jquery.min.js"></script>
    <script>
        new Vue({
            el: 'body',

            data: {
                query: '',
                articles: []
            },

            ready: function () {
                this.client = algoliasearch("02T94JSIW0", "d866daeab49969b88ab26e562503ac08");
                this.index = this.client.initIndex('articles');

                $('#query')
                    .typeahead(null, {
                        source: this.index.ttAdapter(),
                        displayKey: 'title',
//                        templates: {
//                            suggestion: function (hit) {
//                                return (
//                                    '<div class="results">' +
//                                    '<h3 class="title">' + hit._highlightResult.title.value + '</h3>' +
//                                    '<h4 class="published_at">' + hit._highlightResult.published_at.value + '</h4>' +
//                                    '</div>'
//                                );
//                            }
//                        }
                    })
                    .on('typeahead:select', function (e, suggestion) {
                        this.query = suggestion.title;
                    }.bind(this));
            },

            methods: {
                search: function () {
                    this.$log('query');

                    this.index.search(this.query, function (error, results) {
                        this.articles = results.hits;
                    }.bind(this));
                }
            }
        });
    </script>
@endsection