<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterUserRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->authService->register($validatedData);
        return response()->json($response, 201);
    }

    public function login(LoginUserRequest $request){
        $validatedData = $request->validated();
        $response = $this->authService->login($validatedData);
        return response()->json($response, 201);
    }

}
