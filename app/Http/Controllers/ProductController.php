<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('subcategory')->get();
        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sub_categories = \DB::table('sub_categories')
         ->select('id','name')
         ->orderby('id')
         ->get();
        return view('product.create',compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'price' => 'required',
            'weight' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_category_id' => 'required',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $request->image = $imageName;
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
            'weight' => $request->weight,
            'weight' => $request->weight,
            'image' => $imageName,
            'sub_category_id' => $request->sub_category_id,
        ]);
        return redirect()->route('product.index')
             ->with('success_message', 'Berhasil menambah produk baru');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_categories = \DB::table('sub_categories')
         ->select('id','name')
         ->orderby('id')
         ->get();
        $products = Product::find($id);
        // dd($products);
        return view('product.edit',compact('products','sub_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if($request->image != ''){        
            $path = public_path().'/images/';
  
            //code for remove old file
            if($product->image != ''  && $product->image != null){
                $file_old = $path.$product->image;
                unlink($file_old);
            }
  
            //upload new file
            $file = $request->image;
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
  
            //for update in table
            $product->image = $filename;
       }
       $product->name = $request->name;
       $product->description = $request->description;
       $product->status = $request->status;
       $product->price = $request->price;
       $product->weight = $request->weight;
       $product->sub_category_id = $request->sub_category_id;
       $product->save();

       return redirect()->route('product.index')
            ->with('success_message', 'Berhasil mengubah product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $path = public_path().'/images/';
        if($product->image != ''  && $product->image != null){
            $file_old = $path.$product->image;
            unlink($file_old);
        }
        if ($product) $product->delete();
        return redirect()->route('product.index');
    }
}
