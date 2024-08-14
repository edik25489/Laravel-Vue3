<?php

namespace App\Http\Controllers;


use App\Http\Resources\BasketResource;
use App\Models\Basket;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $user = User::find($request->userId);
        $user->basket()->create([
            'product_id'=> $product->id,
        ]);
    }

    public function index(Request $request)
    {
        $user = User::find($request->userId);
        return response()->json(BasketResource::collection($user->basket));
    }

    public function delete(Request $request, Basket $basket)
    {
        return $basket->delete();
    }
    public function buy(Request $request, Basket $basket)
    {
        $user = User::find($request->userId);
        $user->history()->create([
            'product_id'=> $basket->product_id,
            'count'=> $request->count,
        ]);
        $basket->delete();
    }
}
