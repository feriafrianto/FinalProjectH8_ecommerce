<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Cart::where('product_id','=',$request->product_id)->first();
        // echo '<pre>';
        // var_dump($cart);
        if($cart === null){
            Cart::create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        } else {
            $id = $cart->id;
            if ($request->product_id) {
                Cart::whereId($id)->update([
                    'quantity' => $cart->quantity + $request->quantity
                ]);
    	    }
        }
    	return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Cart $cart)
    {
        $cart->update(request()->all());

    	return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

    	return redirect()->back();
    }
}
