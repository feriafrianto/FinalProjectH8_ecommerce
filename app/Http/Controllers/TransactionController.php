<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Transaction;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::latest()->get();
        return view('transaction.index',compact("transactions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with('subcategory')->get();
        $productCarts = Product::has('cart')->get()->sortByDesc('cart.created_at');
        return view('transaction.create',compact('products','productCarts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            auth()->user()
                ->transactions()
                ->create(request()->all())
                ->details()
                ->createMany(Cart::all()->map(function ($cart) { 
                    return [
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                        'subtotal' => $cart->product->price * $cart->quantity
                    ];
                })->toArray());

            DB::table('carts')->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    	
    	return redirect()->route('transaction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->details()->delete();
            $transaction->delete();
        }
        return redirect()->back();
    }
    public function export()
    {
    	$transactions = Transaction::all();
 
    	$pdf = PDF::loadview('transaction.transaction_print',['transactions'=>$transactions]);
    	return $pdf->download('laporan-transaksi-pdf');
    }
}
