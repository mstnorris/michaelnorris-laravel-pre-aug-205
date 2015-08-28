@extends('layouts.master')

@section('header')
    <style>
        body {
            border-top: 1em solid #607d8b;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h1 class="display-4">Sign in</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">


                <form method="POST" action="{{ route('login_path') }}">
                    {!! csrf_field() !!}
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 form-control-label">Email</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="john@appleseed.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 form-control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" name="password" id="password" class="form-control"
                                   placeholder="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-secondary">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection