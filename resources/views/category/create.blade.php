@extends('admin.layout')

@section('content')
<main class="p-4">
    <h1>Create New Category</h1><br>
    
	@if(Session::has('category_created'))
        <p class="text-success">{!! session('category_created') !!}</p>
    
    @endif

    {!! Form::open(['url' => 'category']) !!}

        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', '',array('class'=>'form-control')) !!}
        <span class="text-danger">{{ $errors->first('name') }}</span><br>

        {!! Form::label('description', 'Description: ') !!}
        {!! Form::text('description', '',array('class'=>'form-control')) !!}
        <span class="text-danger">{{ $errors->first('description') }}</span><br>

        {!! Form::submit('Create',array('class'=> 'btn btn-primary')) !!}
        <a href="{{url('/category')}}" class="btn btn-dark">Back</a>

    {!! Form::close() !!}
</main>
@endsection

