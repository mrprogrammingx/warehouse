<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\JwtAuth\GetUserRequest;
use App\Http\Requests\JwtAuth\LoginByTokenRequest;
use App\Http\Requests\JwtAuth\LoginRequest;
use App\Http\Requests\JwtAuth\RegisterRequest;
use App\Services\Auth\JwtAuthService;

class JwtAuthController extends Controller
{
    public $token = true;

    protected $jwtAuthService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->jwtAuthService = new JwtAuthService();
    }

    /**
     * Register user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $result = $this->jwtAuthService->register($request->validated());
        return response()->json($result, $result['status']);
    }

    /**
     * login user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $result = $this->jwtAuthService->login($request->validated());
        return response()->json($result, $result['status']);
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $result = $this->jwtAuthService->logout();
        return response()->json($result, $result['status']);
    }

    public function getUser(GetUserRequest $request)
    {
        $result = $this->jwtAuthService->getUser($request->validated());
        return response()->json($result, $result['status']);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $result = $this->jwtAuthService->respondWithToken($token);
        return response()->json($result, $result['status']);
    }

    /**
     * Refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->jwtAuthService->refresh();
    }


    /**
     * Get user profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json($this->jwtAuthService->profile());
    }

    //gave from mohammad reza
    public function loginByToken(LoginByTokenRequest $request)
    {
        return $this->jwtAuthService->loginByToken($request->validated());
    }
    public function redirectAndAuth(\Illuminate\Http\Request $request) {

        return $this->jwtAuthService->redirectAndAuth($request);
    }


}
