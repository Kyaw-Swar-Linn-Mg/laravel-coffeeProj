@extends('layout/template')


@section('title')
    Order | Coffee Garden
@stop

@section('body')
    @include('partials/nav_bar')
    <div class="container">


        @foreach($order as $orders)
            <div class="col-sm-6 col-md-6">


                <div class="panel @if($orders['status']=='1') panel-success @else panel-primary @endif">
                    <div class="panel-heading">Table Name : {{$orders->tb_name}}<span class="pull-right">Waiter : {{$orders->user->name}}</span> </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders->cart->items as $item)
                                <tr>
                                    <td>{{$item['pd']['title']}}</td>
                                    <td>{{$item['pd']['price']}}</td>
                                    <td>{{$item['qty']}}</td>
                                    <td>{{$item['amount']}}</td>
                                </tr>

                                @endforeach
                            <tr>
                                <td colspan="2">
                                </td>
                                <td>Total Amount :</td>
                                <td>{{$orders->cart->totalPrice}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer">
                        Date : {{$orders->created_at}}
                        <span class="pull-right"><a href="{{route('cash',['id'=>$orders->id])}}">Cash</a> </span>
                    </div>
                </div>
            </div>
            @endforeach

    </div>
    @stop