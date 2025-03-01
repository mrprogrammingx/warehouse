<?php

namespace App\Services\Globals;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;

/**
 * Class CryptService
 * @package App\Services
 */
class CryptService
{
    public static function encrypt($data){
        try {
            return encrypt($data);
        } catch (EncryptException $e) {
            return $e;
        }
    }

    public static function decrypt($data){
        try {
            return decrypt($data);
        } catch (DecryptException $e) {
            return $e;
        }
    }

}
