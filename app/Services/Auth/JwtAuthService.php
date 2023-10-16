<?php

namespace App\Services\Auth;

use App\Interfaces\GlobalVariablesInterface;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Globals\ResponsesService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTAuth;



/**
 * Class JwtAuthService
 * @package App\Services
 */
class JwtAuthService
{
    protected $userRepository,$userService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userService = new UserService();
    }

    public function register(array $data)
    {
        return ResponsesService::success(['user' => $this->userService->store($data)]);
    }

    public function login(array $data)
    {
      //  if (!$token = auth()->attempt($data)) {
        if(!$token = JWTAuth::claims(['code' => $data['personnel_code']])->attempt($data)) {
            return ResponsesService::error(null, $message = 'Authentication was successful', $status = 401, $error = 'Unauthorized');
        }
        return ResponsesService::success($this->respondWithToken($token));
    }

    public function logout()
    {
        auth()->logout();
        return ResponsesService::success(null, 'User logged out successfully!');
    }

    public function getUser(array $data)
    {
        return ResponsesService::success(['user' => JWTAuth::authenticate($data['token'])]);
    }

    public function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * GlobalVariablesInterface::LOGIN_EXPIRED_TIME,
            'user' => auth()->user(),
            'token_expire' => Carbon::now()->addMinutes(119)->timestamp,
        ];
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function profile()
    {
        return auth()->user();
    }

    public function loginByToken(array $data)
    {
        $token = $data['token'];
        $payload = auth()->payload($token);
         $personnelCode = $payload['code'];

        if (!$this->userRepository->personnelCodeExists($personnelCode)) {
            return redirect()->back();
        }
        $user = User::where('personnel_code',$personnelCode)->first();
        $token = JWTAuth::fromUser($user);

        return "<script>
                    localStorage.setItem('access_token', '{$token}');
                    localStorage.setItem('token_expire', '{$payload['exp']}');
                    window.location.href = '/#{$data['path']}';
                </script>";
    }
}
