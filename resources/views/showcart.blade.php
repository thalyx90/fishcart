@extends('template')

@section('content')

    <h2>Your cart</h2>
        
    <div class="cart">
        <div>
            <span><h4>Product</h4></span><span><h4>Price</h4></span><span><h4>Quantity</h4></span><span><h4>Subtotal</h4></span>
        </div>

        @foreach(Cart::contents() as $item)
        
        <div>
            <span>{{$item->name}}</span>
            <span>$ {{$item->price}}</span>
            <span>{{$item->quantity}}</span>
            <span>$ {{$item->price * $item->quantity}}</span>

            <span>
                {{ Form::open(['url' => 'cart-items/'.$item->identifier,'method'=>'delete']) }}
                <input type="submit" value="Delete">
                {{ Form::close() }}
            </span>
        </div>

        @endforeach
       
                    
        <div>
            <span></span><span></span><span><h4>Total</h4></span><span><h4>$ {{Cart::total()}}</h4></span>
        </div>
    </div>

    {{ Form::open(['url' => 'orders']) }}
    <input type="submit" value="Checkout">
    {{ Form::close() }}
     
@stop