@extends('layouts.app')

@section('content')
    <span class="btn-holder"><a href="/products/" class="btn btn-primary btn-block text-center" role="button">Back to Shop</a></span>
    @if(!Auth::guest())
        @if(Auth::user()->id == $product->user_id)
            <span class="btn-holder"><a href="/products/{{ $product->id }}/edit" class="btn btn-primary btn-block text-center" role="button">Edit Product</a></span>
            {!!Form::open(['action' => ['\App\Http\Controllers\ProductsController@destroy', $product->id],'method' => 'POST'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-dark'])}}
            {!!Form::close()!!}
        @endif
    @endif
    <div class="detail-container">
        <div class="detail-img">
            <img src="/storage/photos/{{$product->photo}}" class="img-fluid">
        </div>
        <div class="detail-text">
            <h4>{{ $product->product_name }}</h4>
            <p>{{ $product->product_description }}</p>
        </div>

    </div>



@endsection
