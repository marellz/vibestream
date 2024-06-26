<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller
{

    public function __construct(
        protected readonly UsersService $service
    )
    {
        return [
            // 'auth:api',
            new Middleware('auth:api', except : ['login', 'register']),
        ];
        // $this->middleware('auth:api', ['except' => ['login', 'register', 'check']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $user =  $this->service->create($request);
        $token = Auth::login($user);
        $data['success'] = true;
        $data['authorisation'] = [
            'token' => $token,
            'type' => 'bearer',
        ];
        return $this->respond($data);

    }

    public function check()
    {
        $data['authenticated'] = Auth::check();
        return $this->respond($data);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}