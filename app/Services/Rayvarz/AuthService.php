<?php

namespace App\Services\Rayvarz;

use App\Interfaces\RayvarzInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
    public static function getToken()
    {
        // $response = Http::withHeaders([
        //     'Content-Type' => env('RAYVARZ_HEADER_CONTENT_TYPE_DEFAULT'),
        // ])->post(
        //     env('RAYVARZ_TOKEN_API'),
        //     [
        //         env('RAYVARZ_FIRST_PARAM_FOR_TOKEN_API'),
        //         env('RAYVARZ_SECOND_PARAM_FOR_TOKEN_API')
        //     ]
        // );
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(
            'http://172.16.20.23:9095/testmis/RayvarzApi/Core/Sso/Authenticate',
            [
                '1',
                '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b'
            ]
        );
        if ((200 <= $response->status()) && ($response->status() < 300)) { // true status
            return $response->json();
        } else {
            return null;
        }
    }
}
