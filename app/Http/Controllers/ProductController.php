<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(ProductResource::collection(Product::all()));
    }
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        return response()->json($product);
    }
    public function store(Request $request){
        $path = $request->href->store('/','public');
        return Product::create([
            'name'=> $request->name,
            'href'=> $path,
            'info'=>$request->info,
            'price'=>$request->price,
            'count'=>$request->count,
            'category_id'=>$request->category_id
        ]);
    }
    public function update(Product $product, Request $request): bool
    {
        $path = $request->href->store('/','public');
        return $product::update([
            'name'=> $request->name,
            'href'=> $path,
            'info'=>$request->info,
            'price'=>$request->price,
            'count'=>$request->count,
            'category_id'=>$request->category_id
        ]);
    }
    public function delete(Product $product)
    {
        return $product->delete();
    }
}
