@extends('layout/template')

@section('title')
    Login | Coffee Garden
@stop

@section('body')

    @include('partials/nav_bar')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form method="post" action="{{route('post_login')}}">
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                @if($errors->has('name')) <span class="help-block">{{$errors->first('name')}}</span> @endif
                                <input type="text" name="name" class="form-control" placeholder="Enter Name">
                            </div>
                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                @if($errors->has('password')) <span class="help-block">{{$errors->first('password')}}</span> @endif
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Login</button>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stop