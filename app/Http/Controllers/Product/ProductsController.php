<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(15);
        return view("product.index", ["products" => $products ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "product_name" => "required",
            "product_description" => "required",
            "quantity_in_stock" => "required|numeric",
            "price_per_item" => "required|numeric",
        ]);

        $createdDate = Carbon::now()->format("Y-m-d H:i:s");

        $request->request->add(['created_at' => $createdDate  ]);
        $request->request->add(['updated_at' => Carbon::now()->format("Y-m-d H:i:s") ]);
        $productData =  $request->except('_token');
      
        $product = Product::create(['products_details' =>   $productData ]);
        
        $details = $product->products_details;
       
        return response()->json([
            "product_name" => $details["product_name"] ?? null ,
            "product_description" => $details["product_description"] ?? null ,
            "quantity_in_stock" => $details["quantity_in_stock"] ?? 0,
            "price_per_item" => $details["price_per_item"] ?? 0 ,
           "created_at" =>( new Carbon($createdDate))->diffForHumans()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
