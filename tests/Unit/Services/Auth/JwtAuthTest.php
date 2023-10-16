<?php

namespace Tests\Unit\Services\Auth;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Auth\JwtAuthService;
use Illuminate\Support\Facades\Artisan;
use Tymon\JWTAuth\Facades\JWTAuth;
use Faker\Factory as Faker;


class JwtAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        $user = User::find(1);
        $data = [
            'personnel_code' => $user->personnel_code,
            'password' => config('settings.default.user.password'),
        ];

        $response = $this->jwtAuthService->login($data);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_register()
    {
        $faker = Faker::create();
        $data = [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'password' => config('settings.default.user.password'),
            'mobile' => $faker->phoneNumber, // Use $faker->phoneNumber for mobile
            'user_name' => $faker->userName, // Use $faker->userName for a user name
            'personnel_code' => $faker->unique()->randomNumber, // Generate a random number
        ];
        $response = $this->jwtAuthService->register($data);
        $this->assertTrue($response['status'] >= 200 && $response["status"] < 300);
    }

    public function test_logout()
    {
        // $response = $this->jwtAuthService->logout();
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->post('api/logout');
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_getUser()
    {
        // $response = $this->jwtAuthService->getUser($data);
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->get("api/getUser?token=$this->token");
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertFalse(empty($response['data']["user"]));
    }

    public function test_respondWithToken()
    {
        $response = $this->jwtAuthService->respondWithToken($this->token);
        
        $this->assertTrue(
            is_string($response['access_token']) &&
            $response['token_type'] == 'bearer' &&
            !empty($response['user']) &&
            array_key_exists('expires_in',$response) &&
            array_key_exists('token_expire',$response)
        );
    }

    public function test_refresh(){
        // $response = $this->jwtAuthService->refresh();
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->post('api/refresh');
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'user',
            'expires_in',
            'token_expire',
        ]);

        $this->assertTrue(
            is_string($response['access_token']) &&
            $response['token_type'] == 'bearer' &&
            !empty($response['user']) //&&
        );
    }

    public function test_loginByToken()
    {
        // $response = $this->jwtAuthService->loginByToken($data);
        $response = $this->withHeaders(['Authorization' => "Bearer $this->token"])->get("api/loginByToken?token=$this->token&path=\\");
        $response->assertOk();
    }
}
