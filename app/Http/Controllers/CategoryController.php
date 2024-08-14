<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Category::all());
    }
    public function show(Category $category): \Illuminate\Http\JsonResponse
    {
        return response()->json($category);
    }
    public function store(Request $request){
        $path = $request->href->store('/','public');
        $category = new Category([
            'name'=> $request->name,
            'href'=> $path,
            'description'=>$request->description
        ]);
        $category->save();
    }
    public function edit(Category $category): \Illuminate\Http\JsonResponse
    {
        return response()->json($category);
    }
    public function update(Category $category, Request $request): \Illuminate\Http\JsonResponse
    {
        $path = $request->href->store('/','public');
        $category::update([
            'name'=> $request->name,
            'href'=> $path,
            'description'=>$request->description
        ]);
        return response()->json($category);
    }
}
