<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function session(Request $request)
    {
//    !!! CODE QUELLEN:
//    !!! Shoppingcart/Stribeseinbinung:  https://www.youtube.com/watch?v=rQV9aI3LLnk
//        --> Laravel 10 Shopping Cart add to cart with Stripe Payment Gateway

        $productItems = [];

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        foreach (session('cart') as $id => $details) {

            $product_name = $details['product_name'];
            echo $product_name;
            $total = $details['price'];
            $quantity = $details['quantity'];

//            $two0 = "00";
            $unit_amount = str_replace([',', '.'], ['', ''], "$total");

            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency'     => 'USD',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $quantity
            ];
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' => "0001"
            ],
            'customer_email' => "cairocoders-ednalan@gmail.com", //$user->email,
            'success_url' => route('success'),
            'cancel_url'  => route('cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function success()
    {
        return view('success');
    }

    public function cancel()
    {
        return view('cancel');
    }
}
