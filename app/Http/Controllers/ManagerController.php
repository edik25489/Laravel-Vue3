<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    public function managerInfo(Request $request)
    {
        $user = Manager::find($request->managerId);
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
        $user = Manager::create(["password" => Hash::make($request->password)] + $request->all());
        $success['token'] = $user->createToken("token-manager")->plainTextToken;
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
        if (Auth::guard('manager')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            $user = Auth::guard('manager')->user();
            $token = $user->createToken("token-manager")->plainTextToken;
            $success['token'] = $token;
            $success['user'] = $user->id;
            $response = [
                'success'=>true,
                'data'=>$success,
                'message'=>'Авторизация менеджера прошла успешно'
            ];
            return response()->json($response, 200);
        }
        else{
            $response = [
                'success'=>false,
                'message'=>'Попытка авторизации менеджера провалена'
            ];
            return response()->json($response, 400);
        }
    }
}
