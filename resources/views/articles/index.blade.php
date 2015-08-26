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

        .card {
            background: white;
            padding: 0 1em;
            border-radius: 0;
            border: none;
            /*box-shadow: 0 2px 5px rgba(55, 55, 55, .3);*/
            min-height: 480px;
            margin: 0;
        }

        .card .card-block {
            border-radius: 0;
            border: none;
            padding: 0;
            min-height: 480px;
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
            background: rgba(255,255,255,.8);
        }

        ul li {
            margin: 1em 0;
            background: white;

        }

        p.card-footer {
            background: none;
            border: none;
        }
    </style>
@endsection

@section('content')

    <div class="container-fluid">
        @foreach ( $articles as $article )

            <div class="row">
                <article>
                    <div class="article-background-pattern"
                         style='background-image: {{ $article->header_image_path }}'></div>
                    <div class="card">
                        <div class="card-block">

                            <h3 class="article-title">{{ $article->title }}</h3>

                            <div class="article-body">
                                {{ $article->body }}
                            </div>
                        </div>

                        <p class="card-text card-footer text-right">
                                    <small class="text-muted"><i
                                                class="fa fa-fw fa-clock-o"></i> {{ $article->published_at->diffForHumans() }}
                                        </small>
                        </p>
                    </div>
                </article>

            </div>
        @endforeach

        <div class="row">
            {!! $articles->render() !!}
        </div>

    </div>

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