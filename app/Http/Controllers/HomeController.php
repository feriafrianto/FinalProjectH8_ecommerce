<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produk = Product::all();
        $productcount = $produk->count();
        $transaction = Transaction::all();
        $transactioncount = $transaction->count();
        $user = User::all();
        $usercount = $user->count();
        $total = DB::table('transactions')->sum('total');
        return view('home',compact("productcount","transactioncount","usercount","total"));
    }
}
