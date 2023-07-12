<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{

//    !!! CODE QUELLEN:
//    !!! PHP/Laravel/phpMyAdmin/Bootstrabs/User+Auth etc.:   https://www.youtube.com/watch?v=EcYXsp78Xy8&t=4812s
//    ---> Laravel PHP Framework Tutorial - Full Course for Beginners | Build a Blog with Laravel

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function cart()
    {
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }  else {
            $cart[$id] = [
                "product_name" => $product->product_name,
                "photo" => $product->photo,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_description' => 'required',
            'photo' => 'required|max:1999',
            'price' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            //get Filenmae with extensions
            $fielNameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($fielNameWithExt, PATHINFO_FILENAME);
            //get the ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('photo')->storeAs('public/photos', $fileNameToStore);
        } else {
            $fileNameToStore = 'img1.jpg';
        }
       $product = new Product;
       $product->product_name = $request->input('product_name');
       $product->product_description = $request->input('product_description');
       $product->price = $request->input('price');
       $product->user_id = auth()->user()->id;
       $product->photo = $fileNameToStore;
       $product->save();

       return redirect('/products')->with('success', 'Product added to the Shop!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product =  Product::find($id);
        return view('show_product')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product =  Product::find($id);
        if (auth()->user()->id !== $product->user_id) {
            return redirect('products')->with('error', 'Unauthorized page');
        }
        return view('edit_product')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'product_name' => 'required',
            'product_description' => 'required',
            'photo' => 'required',
            'price' => 'required',
        ]);

        //handle the fileupload
        if($request->hasFile('photo')) {
            //get Filenmae with extensions
            $fielNameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($fielNameWithExt, PATHINFO_FILENAME);
            //get the ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //upload image
            $path = $request->file('photo')->storeAs('public/photos', $fileNameToStore);
        }

        $product = Product::find($id);
        $product->product_name = $request->input('product_name');
        $product->product_description = $request->input('product_description');
        $product->photo = $request->input('photo');
        $product->price = $request->input('price');
        if ($request->hasFile('photo')) {
            $product->photo = $fileNameToStore;
        }
        $product->save();

        return redirect('/products')->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (auth()->user()->id !== $product->user_id) {
            return redirect('products')->with('error', 'Unauthorized page');
        }
        $product->delete();
        return redirect('/products')->with('success', 'Product Deleted!');
    }
}
