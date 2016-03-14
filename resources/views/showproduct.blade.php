@extends('template')

@section('content')

		<h2>Product Details</h2>
		
		<h4>{{$product->name}}</h4>
		<p>{{$product->description}}</p>
		<p><i class="icon-dollar"></i> {{$product->price}}</p>


		{{ Form::open(['url' => 'cart-items']) }}
		{{ Form::label('quantity', 'Quanity.') }}
		{{ Form::text('quantity',1) }}
		{{ Form::hidden('product_id', $product->id)}}
		<input type="submit" value="Add">
		{{ Form::close() }}



		{{ Form::open(['url'=>'products/'.$product->id, 'method'=>'delete']) }}
			<input type="submit" value="Delete">
		{{ Form::close() }}
		

@stop			
		