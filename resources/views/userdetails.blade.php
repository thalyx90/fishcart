@extends('template')

@section('content')
		
		<h2>Your Details</h2>

		<h4>First name:</h4>
		<div  data-editable="firstname"
			data-url="{{url('users/'.$user->id)}}"
		>{!!$user->firstname!!}</div>

		<h4>Last name:</h4>
		<div 	data-editable="lastname"
			data-url="{{url('users/'.$user->id)}}"
		>{!!$user->lastname!!}</div>

		<h4>Email:</h4>
		<p 	data-editable="email"
			data-url="{{url('users/'.$user->id)}}"
		>{!!$user->email!!}</div>


		<div id="token">{{csrf_token()}}</div>

@stop			
		