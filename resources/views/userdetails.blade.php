@extends('template')

@section('content')
		
		<h2>Your Details</h2>

		<h4>First name:</h4>
		<p>{{$user->firstname}}</p>

		<h4>Last name:</h4>
		<p>{{$user->lastname}}</p>

		<h4>Email:</h4>
		<p>{{$user->email}}</p>

@stop			
		