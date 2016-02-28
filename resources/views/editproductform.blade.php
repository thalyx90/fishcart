@extends('template')

@section('content')

    <h2>Edit product</h2>
    {!! Form::model($product,array('url' => 'products/'.$product->id,'method' =>'put')) !!}
        <fielset>
            <label for="">name.</label>
            {{Form::text('name')}}
            {!! $errors->first('name', '<p class="error">:message</p>')!!}
            
            <label for="">description.</label>
            {{Form::text('description')}}
            {!! $errors->first('description', '<p class="error">:message</p>')!!}
            
            <label for="">Price.</label>
            {{Form::text('price')}}
            {!! $errors->first('price', '<p class="error">:message</p>')!!}
            
            <label for="">photo.</label>
            {{Form::text('photo')}}
            {!! $errors->first('photo', '<p class="error">:message</p>')!!}
            
            <label for="">Type.</label>
            {{Form::select('type_id', \App\Models\Type::lists('name','id'))}}
            {!! $errors->first('type_id', '<p class="error">:message</p>')!!}

            <input type="submit" value="Update">
        </fielset>
    {!! Form::close() !!}
     
@stop