<?php

namespace Tests\Unit\Services\Globals;

use App\Services\Globals\ResponsesService;
use PHPUnit\Framework\TestCase;

class ResponsesTest extends TestCase
{
    public ResponsesService $responsesService;
    public \Exception $e;
    public function setUp():void
    {
        parent::setUp();
        $this->e = new \Exception();
        $this->responsesService = new ResponsesService();
    }

    public function test_success()
    {
        $response = $this->responsesService::success($data=['test'],$message = 'Done successfully',$status = 200,$error ='Nothing');
        $this->assertTrue(
            $response['success'] == true &&
            $response['status'] == $status &&
            $response['error'] == $error &&
            $response['message'] == $message &&
            $response['data'] == $data
        );
    }

    public function test_error()
    {
        $response = $this->responsesService::error($data=['test'],$message = 'Failed to complete successfully',$status = 400,$error ='Nothing');
        $this->assertTrue(
            $response['success'] == false &&
            $response['status'] == $status &&
            $response['error'] == $error &&
            $response['message'] == $message &&
            $response['data'] == $data
        );
    }

    public function test_exception()
    {
        $response = $this->responsesService::exception($e = $this->e,$status = 500);
        $this->assertTrue(
            $response['success'] == false &&
            $response['status'] == $status &&
            $response['error'] == $e->getMessage() &&
            $response['message'] == $e->getMessage() &&
            $response['data'] == ''
        );
    }
}
