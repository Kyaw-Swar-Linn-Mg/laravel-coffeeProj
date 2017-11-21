@extends('layout/template')


@section('title')
    Welcome to Coffee Garden
    @stop

@section('body')
    @include('partials/nav_bar')


        <div class="row">
            <div class="col-md-6">
                @foreach($pd as $pds)
                    <a href="{{route('add_to_cart',['id'=>$pds->id])}}">
                        <div class="col-sm-3 col-md-3">
                            <div class="thumbnail">
                                <img src="{{route('cover',['cover'=>$pds->cover])}}" class="img-rounded" style="width: 100px;height: 80px" alt="...">
                                <div class="caption">
                                    <p><a href="#">{{$pds->title}}</a></p>
                                    <p>{{$pds->price}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Cart<a href="{{route('clear-cart')}}" class="pull-right text-info">Clear Cart</a> </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                            @if(Session::has('cart'))
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item['pd']['title']}}</td>
                                    <td>{{$item['pd']['price']}}</td>
                                    <td><a href="{{route('decrease',['id'=>$item['pd']['id']])}}"><span class="fa fa-minus-circle"></span></a> {{$item['qty']}} <a href="{{route('increase',['id'=>$item['pd']['id']])}}"><span class="fa fa-plus-circle"></span></a> </td>
                                    <td>{{$item['amount']}}</td>

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"></td>
                                <td>Total Qty:{{$totalQty}}</td>
                                <td>Total Amount:{{$totalPrice}}</td>
                            </tr>
                                @endif
                        </table>
                        @if(Session::has('cart'))
                            <form method="post" action="{{route('checkout')}}">
                                <div class="form-group">
                                    <select name="tb_name" class="form-control">
                                        <option>One</option>
                                        <option>Two</option>
                                        <option>Three</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Check Out</button>
                                </div>
                                {{csrf_field()}}
                            </form>
                            @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    @stop