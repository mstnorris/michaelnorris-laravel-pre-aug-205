@extends('layouts.master')

@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
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


        <div id="infinite-scroll" class="jscroll">
            <div class="row" v-repeat="articles['data'] | filterBy search" debounce="500">

                <article class="item">
                    <div class="article-background-pattern"
                         style='background-image: @{{ header_image_path }}'></div>

                    <div class="card">
                        <div class="card-block">


                            <h3 class="article-title"><a href="@{{ id }}">@{{ title }}</a>

                                <small class="pull-right text-fixed-width"><span class="label label-pill label-default"><a
                                            href="@{{ id }}">@{{ id }}</a></span></small>
                            </h3>

                            <div class="article-body">
                                <p class="text-justify">@{{ body }}</p>
                            </div>
                        </div>

                        <p class="card-text card-footer">
                            <small class="text-muted">
                                <i class="fa fa-fw fa-tags"></i>
                                {{--@foreach ( $article->tags as $tag )--}}
                                {{--<a href="{{ route('individual_tag_path', $tag->name) }}"><span class="label label-pill label-default">{{ $tag->name }}</span></a>--}}
                                {{--@endforeach--}}
                            </small>
                                <span class="pull-right"><small class="text-muted"><i
                                            class="fa fa-fw fa-clock-o"></i>

                                    </small></span>
                        </p>
                    </div>
                </article>

            </div>
            <a href="@{{ articles['next_page'] }}" class="jscroll-next">yep</a>
        </div>


    </div>

@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-infinitescroll/2.1.0/jquery.infinitescroll.min.js"></script>
    <script>
        $('#infinite-scroll').infinitescroll({

            navSelector  : "div.navigation",
            // selector for the paged navigation (it will be hidden)
            nextSelector : "a.jscroll-next",
            // selector for the NEXT link (to page 2)
            itemSelector : "#infinite-scroll"
            // selector for all items you'll retrieve
        });
    </script>
    {{--<script src="/js/jquery.jscroll.min.js"></script>--}}
    {{--<script>--}}
        {{--$('.jscroll').jscroll({--}}
            {{--loadingHtml: '<p class="text-center" style="color:#607d8b"><i class="fa fa-circle-o-notch fa-spin"></i></p>',--}}
            {{--padding: 20,--}}
            {{--nextSelector: '.jscroll-next'--}}
        {{--});--}}
    {{--</script>--}}

    <script src="/js/sticky.js"></script>
    <script>
        $('.article-background-patter').Stickyfill();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.10/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.1.14/vue-resource.min.js"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

        new Vue({
            el: '#articles',

            data: {
                search: '',
                newArticle: {
                    id: '',
                    title: '',
                    body: '',
                    header_image_path: '',
                    is_private: '',
                    published: '',
                    'next_page': ''
                },

                submitted: false
            },

            computed: {
                errors: function () {
                    for (var key in this.newArticle) {
                        if (!this.newArticle[key]) return true;
                    }

                    return false;
                }
            },

            ready: function () {
                this.fetchArticles();
            },

            methods: {
                fetchArticles: function () {
                    this.$http.get('api/articles', function (articles) {
                        this.$set('articles', articles);
                    })
                },

                onSubmitForm: function (e) {
                    e.preventDefault();

                    var article = this.newArticle;

                    this.articles.push(article);

                    this.newArticle = {
                        id: '',
                        title: '',
                        body: '',
                        header_image_path: '',
                        is_private: '',
                        published: '',
                        next_page: ''
                    };

                    this.submitted = true;

                    this.$http.post('api/articles', article);
                }
            }
        });
    </script>

@endsection