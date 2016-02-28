@extends('template')


@section('content')			
	<h2>Login</h2>

	{{ Form::open(['url' => 'login']) }}
	<fielset>
		{{ Form::label('username', 'Username.') }}
		{{ Form::text('username') }}
		{!! $errors->first('username','<p class="error">:message</p>') !!}

		{{ Form::label('password', 'Password.') }}
		{{ Form::password('password') }}
		{!! $errors->first('password','<p class="error">:message</p>') !!}


		<input type="submit" value="Login">
	</fielset>
	{{ Form::close() }}

@endsection		
