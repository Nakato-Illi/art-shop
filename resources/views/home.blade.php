{{-- Automatische Seite von Laravel für den Log in Prozess --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('You are logged in!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if( ($products) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($products as $product)
                                    <tr>
                                        <th>{{$product->product_name}}</th>
                                        <th><a href="/posts/{{$product->id}}/edit" class="bth btn-danger">Edit</a></th>
                                        <th></th>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                        @endif
                        <a href="/products/create" class="btn btn-primary">Create a new Product</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
