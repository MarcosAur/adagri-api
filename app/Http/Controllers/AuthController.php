<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest, LoginService $loginService){
        $data = $loginRequest->validated();
        $token = $loginService->run($data);

        return response($token, 200);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response('', 204);
    }

    public function user(Request $request){
        return response($request->user(), 200); 
    }
}
