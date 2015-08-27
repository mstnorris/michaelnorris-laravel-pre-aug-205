@extends('layouts.master')

@section('header')

@endsection

@section('content')

    <div class="container-fluid">

        @foreach ( $tag->articles as $article )

            <div class="row">
               <h1>{{ $article->title }}</h1>
            </div>

        @endforeach

    </div>

@endsection

@section('footer')


@endsection