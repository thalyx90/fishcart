@extends('template')

@section('content')
		<h2>Update user details</h2>
		{{ Form::model($user,array('url'=>'users/'.$user->id,'method'=>'put')) }}
			<fieldset>
				<label for="">Usename.</label>
				{{Form::text('username')}}
				{!!$errors->first('username','<p class="error">:message<p>')!!}

				<label for="">Email.</label>
				{{Form::text('email')}}
				{!!$errors->first('email','<p class="error">:message<p>')!!}

				<label for="">Firstname.</label>
				{{Form::text('firstname')}}
				{!!$errors->first('firstname','<p class="error">:message<p>')!!}

				<label for="">Lastname.</label>
				{{Form::text('lastname')}}
				{!!$errors->first('lastname','<p class="error">:message<p>')!!}
				<input type="submit" value="Update">
			</fieldset>
		{{Form::close()}}
			


@stop			
		