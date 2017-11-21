@extends('layout/template')

@section('title')
    Dashboard | Coffee Garden
@stop

@section('body')

    @include('partials/nav_bar')

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">New Products</div>
                    <div class="panel-body">
                        <form method="post" action="{{route('post_new_data')}}" enctype="multipart/form-data">
                            <div class="form-group @if($errors->has('title')) has-error @endif">
                                @if($errors->has('title')) <span class="help-block">{{$errors->first('title')}}</span> @endif
                                    <input type="text" name="title" class="form-control" placeholder="Enter Product Name">
                            </div>
                            <div class="form-group @if($errors->has('price')) has-error @endif">
                                @if($errors->has('price')) <span class="help-block">{{$errors->first('price')}}</span> @endif
                                <input type="number" name="price" class="form-control" placeholder="Enter Price">
                            </div>
                            <div class="form-group @if($errors->has('cover')) has-error @endif">
                                @if($errors->has('cover')) <span class="help-block">{{$errors->first('cover')}}</span> @endif
                                    <input type="file" name="cover" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Save</button>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>

        </div>

    @stop