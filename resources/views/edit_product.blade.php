@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\ProductsController@update', $product->id],  'method' => 'POST','enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('product_name', 'Product Name')}}
        {{Form::text('product_name', $product->product_name, ['class' => 'form-control', 'placeholder' => 'Product Name'])}}
    </div>
    <div class="form-group">
        {{Form::label('product_description', 'Product Description')}}
        {{Form::textarea('product_description', $product->product_description, ['class' => 'form-control', 'placeholder' => 'Product Description'])}}
    </div>
    <div class="form-group">
        {{Form::label('price', 'Product Price')}}
        {{Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Product Price'])}}
    </div>
    <div class="card-group">
        {{Form::file('photo')}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
