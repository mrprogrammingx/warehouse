<?php

namespace App\Http\Middleware;

use App\Interfaces\RayvarzInterface;
use App\Services\Rayvarz\AuthService;
use Closure;
use Exception;
use Illuminate\Http\Request;

class RayvarzMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (!$request->hasCookie('rayvarz_access_token')) {
                $rayvarzAccessToken = AuthService::getToken();
                if (!$rayvarzAccessToken || $rayvarzAccessToken == null || !is_string($rayvarzAccessToken)) {
                    return response()->json(['status' => 'Rayvarz Token is Invalid!'], 401);
                }
                setcookie("rayvarz_access_token", $rayvarzAccessToken, time() + RayvarzInterface::TOKEN_EXPIRED_TIME , null, null);
                header("Refresh:0;");
            }
        } catch (Exception $e) {
            return response()->json(['status' => 'Rayvarz Token is Invalid!',$e], 401);
        }
        return $next($request);
    }
}
