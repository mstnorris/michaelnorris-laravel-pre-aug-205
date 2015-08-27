@extends('layouts.master')

@section('header')
    <style>
        h1.display-4 {
            color: #607d8b;
        }

        article {
            background: white;
            width: 100%;
            height: 100%;
            margin: 0;
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
            height:100%;
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
            background-image:
            linear-gradient(
                white 60%, rgba(255,255,255,0)
            );
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

    </style>
@endsection

@section('content')

    <div class="container-fluid">

            @foreach ( $articles as $article )

                <div class="row">
                    <article class="item">
                        <div class="article-background-pattern"
                             style='background-image: {{ $article->header_image_path }}'></div>
                        <div class="card">
                            <div class="card-block">

                                <h3 class="article-title">{{ $article->title }}</h3>

                                <div class="article-body">
                                    <p class="text-justify">{{ $article->body }}</p>
                                </div>
                            </div>

                            <p class="card-text card-footer">
                                <small class="text-muted">
                                    <i class="fa fa-fw fa-tags"></i>
                                    @foreach ( $article->tags as $tag )
                                        <a href="{{ route('individual_tag_path', $tag->id) }}"><span class="label label-pill label-default">{{ $tag->name }}</span></a>
                                    @endforeach
                                </small>
                                <span class="pull-right"><small class="text-muted"><i
                                        class="fa fa-fw fa-clock-o"></i> {{ $article->published_at->diffForHumans() }}
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
@endsection


@section('footer-old')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.14/vue-resource.min.js"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

        new Vue({
            el: '#articles',

            data: {
                newArticle: {
                    title: '',
                    body: '',
                    header_image_path: '',
                    published_at: ''
                },

                submitted: false
            },

            computed: {
                errors: function() {
                    for ( var key in this.newArticle) {
                        if ( ! this.newArticle[key]) return true;
                    }

                    return false;
                }
            },

            ready: function() {
                this.fetchArticles();
            },

            methods: {
                fetchArticles: function() {
                    this.$http.get('api/articles', function(articles) {
                        this.$set('articles', articles);
                    })
                },

                onSubmitForm: function(e) {
                    e.preventDefault();

                    var article = this.newArticle;

                    this.articles.push(article);

                    this.newArticle = { title: '', body: '', header_image_path: '', published_at: '' };

                    this.submitted = true;

                    this.$http.post('api/articles', article);
                }
            }
        });
    </script>

@endsection