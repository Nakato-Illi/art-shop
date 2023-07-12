@extends('layouts.app')

@section('content')
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="/storage/photos/{{$details['photo']}}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['product_name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ $details['price'] }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}"
                               class="form-control quantity cart_update" min="1"/>
                    </td>
                    <td data-th="Subtotal" class="text-center">${{ $details['price'] * $details['quantity'] }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm cart_remove"><i class="fa fa-trash-o"></i> Delete</button>
                    </td>
                </tr>
            @endforeach
        @else
            <p>No Procu</p>
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" style="text-align:right;"><h3><strong>Total ${{ $total }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" style="text-align:right;">
                <form action="/session" method="POST">
                    <a href="{{ url('products') }}" class="btn btn-danger"> <i class="fa fa-arrow-left"></i> Continue
                        Shopping</a>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button class="btn btn-success" type="submit" id="checkout-live-button"><i class="fa fa-money"></i>
                        Checkout
                    </button>
                </form>
            </td>
        </tr>
        </tfoot>
    </table>
@endsection
