<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(HistoryResource::collection(User::find($request->userId)->history));
    }
}
