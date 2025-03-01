<?php

namespace Tests;

use App\Models\User;
use App\Services\Auth\JwtAuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public $jwtAuthService;
    public $loginData;
    public $token;
    public function setUp():void
    {
        parent::setUp();
        Artisan::call('db:seed');
        $this->jwtAuthService = new JwtAuthService();
        $this->loginData = $this->login();
        $this->token = $this->loginData['access_token'];
    }
    protected function initDatabase()
    {
        Artisan::call('migrate');
    }

    protected function resetDatabase()
    {
        Artisan::call('migrate:reset');
    }

    public function login()
    {
        // $this->jwtAuthService = new JwtAuthService();
        $user = User::find(1);

        $data = [
            'personnel_code' => $user->personnel_code,
            'password' => config('settings.default.user.password'),
        ];

        return $this->jwtAuthService->login($data)['data'];
    }
}
