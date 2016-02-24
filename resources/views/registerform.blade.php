@extends('template')

@section('content')
		<h2>Register New Account</h2>
		{{ Form::open(array('url' => 'users')) }}
			<fieldset>
				<label for="">Usename.</label>
				{{Form::text('username')}}
				{!!$errors->first('username','<p class="error">:message<p>')!!}

				<label for="">Email.</label>
				{{Form::text('email')}}
				{!!$errors->first('email','<p class="error">:message<p>')!!}
			
				<label for="">Password.</label>
				{{Form::password('password')}}
				{!!$errors->first('password','<p class="error">:message<p>')!!}

				<label for="">Confirmed password.</label>
				{{Form::password('password_confirmation')}}
				{!!$errors->first('password_confirmation','<p class="error">:message<p>')!!}
				
				<label for="">Firstname.</label>
				{{Form::text('firstname')}}
				{!!$errors->first('firstname','<p class="error">:message<p>')!!}

				<label for="">Lastname.</label>
				{{Form::text('lastname')}}
				{!!$errors->first('lastname','<p class="error">:message<p>')!!}

				<input type="reset" value="Reset">
				<input type="submit" value="Create">
			</fieldset>
		{{Form::close()}}
			


@stop			
		