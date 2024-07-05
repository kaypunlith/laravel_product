@extends('admin.layout')

@section('content')
<main class="p-4">
    <div class="container-fluid">
        <h1 class="mt-4">Create New Product</h1>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('product_create'))
                <div class="alert alert-primary alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    {{ session('product_create') }}
                </div>
                @endif
                <!-- It Create the new Category -->

                {{ Form::open(['url'=>'product', 'files'=>'true']) }}

                    {!! Form::label('catId', 'Category:') !!}
                    {!! Form::select('catId',$categories,null ,array('class'=>'form-select')) !!}
                    <span class="text-danger">{{ $errors->first('catId') }}</span><br>

                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name',null, array('class'=>'form-control')) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span><br>

                    {!! Form::label('price', 'Price:') !!}
                    {!! Form::text('price',null, array('class'=>'form-control')) !!}
                    <span class="text-danger">{{ $errors->first('price') }}</span><br>

                    {!! Form::label('image', 'Image:') !!}
                    {!! Form::file('image', array('class'=>'form-control')) !!}
                    <span class="text-danger">{{ $errors->first('image') }}</span><br>

                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description',null, array('class'=>'form-control')) !!}
                    <span class="text-danger">{{ $errors->first('description') }}</span><br>

                    {!! Form::submit('create', array('class'=>'btn btn-primary')) !!}
                    <a class="btn btn-dark" href="{{ url('/product') }}">Back</a>

                {{ Form::close() }}

            </div>
        </div>
    </div>
</main>

@endsection