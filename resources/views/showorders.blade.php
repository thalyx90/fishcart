@extends('template')

@section('content')

    <h2>Your orders</h2>
     
    @foreach($orders as $order)
    <h3>Order {{$order->id}}: {{$order->status}}</h3>

    <div class="cart">
        <div>
            <span><h4>Product</h4></span><span><h4>Price</h4></span><span><h4>Quantity</h4></span><span><h4>Subtotal</h4></span>
        </div>

        @foreach($order->products as $product)
        <div>
            <span>{{$product->name}}</span>
            <span>$ {{$product->price}}</span>
            <span>{{$product->pivot->quantity}}</span>
            <span>$ ?</span>

        </div>

        @endforeach
          
    </div>
    @endforeach

@stop