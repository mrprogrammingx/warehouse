<?php

namespace App\Services\Globals;

use Exception;
use Hekmatinasser\Verta\Verta;
/**
 * Class ResponsesService
 * @package App\Services
 */
class ResponsesService
{
    
    public static function success($data='', string $message = 'Done successfully', int $status=200, $error=''):array
    {
        return [
                'success' => true,
                'status' => $status,
                'error' => $error,
                'message' => $message,
                'data' => $data,
        ];
    }

    public static function error($data='', string $message = 'Failed to complete successfully', int $status=400, $error=''):array
    {
        return [
            'success' => false,
            'status' => $status,
            'error' => $error,
            'message' => $message,
            'data' => $data,
        ];
    }

    public static function exception($exception, int $status = 500):array
    {
        return [
            'success' => false,
            'status' => $status,
            'error' => $exception->getMessage(),
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
            'data' => '',
        ];
    }

}
