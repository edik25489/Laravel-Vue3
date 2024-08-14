<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function userInfo(Request $request)
    {
        $user = User::find($request->userId);
        return [
            'name'=>$user->name,
            'surname'=>$user->surname,
        ];
    }
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'surname'=>'required',
            'telefon'=>'required',
            'birthday'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if ($validator->fails()){
            $response = [
                'success'=>false,
                'message'=>$validator->errors()
            ];
            return response()->json($response, 400);
        }
        $user = User::create(["password" => Hash::make($request->password)] + $request->all());

        $success['token'] = $user->createToken("token-user")->plainTextToken;
        $success['user'] = $user->id;
        $response = [
            'success'=>true,
            'data'=>$success,
            'message'=>'Регистрация прошла успешно'
        ];
        return response()->json($response, 200);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->fails()){
            $response = [
                'success'=>false,
                'message'=>$validator->errors()
            ];
            return response()->json($response, 400);
        }
        if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::user();
            $token = $user->createToken("token-user")->plainTextToken;
            $success['token'] = $token;
            $success['user'] = $user->id;
            $response = [
                'success'=>true,
                'data'=>$success,
                'message'=>'Авторизация пользователя прошла успешно'
            ];
            return response()->json($response, 200);
        }
        else{
            $response = [
                'success'=>false,
                'message'=>'Попытка авторизации пользователя провалена'
            ];
            return response()->json($response, 400);
        }
    }
}
