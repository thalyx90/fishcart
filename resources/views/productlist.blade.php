@extends('template')

@section('content')
		<h2>{{$type->name}}</h2>

		<?php $products = $type->products()->paginate(6);?>

		@foreach( $products as $product)

			<article class="group">

				<img src="{{asset('productphotos/'.$product->photo)}}" alt="">

				<h4>{{$product->name}}</h4>
				<p>{{$product->description}}</p>
				<span class="price"><i class="icon-dollar"></i> {{$product->price}}</span>
				<a href="{{url('products/'.$product->id)}}" class="addtocart"><i class="icon-plus"></i></a>
			</article>

		@endforeach

		{!!$products->links()!!}


@stop			
		