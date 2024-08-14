<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::find($request->userId);
        return response()->json(FavoriteResource::collection($user->favorite));
    }
    public function store(Request $request, Product $product)
    {
        $user = User::find($request->userId);
        $user->favorite()->create([
            'product_id'=> $product->id,
        ]);
    }
    public function delete(Request $request, Favorite $favorite)
    {
        return $favorite->delete();
    }
}
