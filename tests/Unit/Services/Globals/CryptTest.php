<?php

namespace Tests\Unit\Services\Globals;

use App\Services\Globals\CryptService;
use Tests\TestCase;

class CryptTest extends TestCase
{
    public CryptService $cryptService;
    public function setUp():void
    {
        parent::setUp();
        $this->cryptService = new CryptService();
    }

    public function test_encrypt()
    {
        $text = "test";
        $response = $this->cryptService->encrypt($text);
        $this->assertTrue(decrypt($response) == $text);
    }

    public function test_decrypt()
    {
        $text = "test";
        $encrypted = encrypt($text);
        $response = $this->cryptService->decrypt($encrypted);
        $this->assertTrue($response == $text);
    }
}