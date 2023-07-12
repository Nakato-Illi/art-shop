{{--   Indexseite für Productanzeige. Werden von der Datenbank gelesen   --}}

@extends('layouts.app')

@section('content')
    @if(Auth::guest())
    <div class="cart-side cart-fixed">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12">
                    <div class="dropdown">

                        <button id="dLabel" type="button" class="btn btn-primary" data-bs-toggle="dropdown">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span
                                class="badge bg-danger">{{ count((array) session('cart')) }}</span>
                        </button>

                        <div class="dropdown-menu cart-with" aria-labelledby="dLabel">
                            <div class="row total-header-section">
                                @php $total = 0 @endphp
                                @foreach((array) session('cart') as $id => $details)
                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                @endforeach
                                <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                    <p>Total: <span class="text-success">$ {{ $total }}</span></p>
                                    {{--                                    <p>Total: <span class="text-success"> 23 €</span></p>--}}
                                </div>
                            </div>
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    <div class="row cart-detail">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img width="60" height="60" src="/storage/photos/{{ $details['photo'] }}"/>
                                            {{--                                            <img width="70" src="{{ asset('img') }}/img1.jpg"/>--}}
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p>{{ $details['product_name'] }}</p>
                                            {{--                                            <p>Title Art</p>--}}
                                            <span class="price text-success"> ${{ $details['price'] }}</span> <span
                                                class="count"> Quantity:{{ $details['quantity'] }}</span>
                                            {{--                                            <span class="price text-success"> 14 €</span> <span class="count"> Quantity: 2</span>--}}
                                        </div>

                                    </div>
                                @endforeach
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                    <a href="{{ route('cart') }}" class="btn btn-primary btn-block" style="margin-top: 10px; width: 100%">View all</a>
                                    {{--                                    <a href="#" class="btn btn-primary btn-block">View all</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        @foreach($products as $product)
            <div class="col-xs-18 col-sm-6 col-md-4" style="margin-top:10px;">
                <div class="img_thumbnail productlist">
                    <img style="height: 400px; width: 400px" src="/storage/photos/{{$product->photo}}" class="img-fluid">
                    <div class="caption" style="margin-bottom: 50px">
                        <h4>{{ $product->product_name }}</h4>
                        <p><strong>Price: </strong> ${{ $product->price }}</p>
                        <span class="btn-holder"><a href="/products/{{$product->id}}" class="btn btn-primary btn-block text-center" role="button" >Details</a></span>
                        @if(Auth::guest())
                        <span class="btn-holder"><a href="{{ route('add_to_cart', $product->id) }}" class="btn btn-primary btn-block text-center" role="button">Add to cart</a></span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
