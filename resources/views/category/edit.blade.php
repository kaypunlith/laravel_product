@extends('admin.layout')
@section('content')
    <main class="p-4">
        <h1>Edit Category</h1>
        @if(Session::has('category_updated'))
            <p class="text-success">{{ session('category_updated') }}</p>
        @endif
        {{ Form::model($category, array('route' => array('category.update', $category->id),'method'=>'PUT' )) }}

            {{ Form::label('name', 'Name: ') }}
            {{ Form::text('name', null ,array('class'=>'form-control')) }}
            <span class="text-danger">{{ $errors->first('name') }}</span><br>

            {{ Form::label('description', 'Description: ') }}
            {{ Form::text('description', null ,array('class'=>'form-control')) }}
            <span class="text-danger">{{ $errors->first('description') }}</span><br>

            {{ Form::submit('Update',array('class'=> 'btn btn-primary')) }}
            <a href="{{url('/category')}}" class="btn btn-dark">Back</a>

        {{ Form::close() }}
    </main>
@endsection
