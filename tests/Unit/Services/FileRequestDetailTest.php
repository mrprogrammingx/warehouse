<?php

namespace Tests\Unit\Services;

use App\Repositories\FileRequestDetailRepository;
use App\Services\FileRequestDetailService;
use Tests\TestCase;

class FileRequestDetailTest extends TestCase
{
    public $fileRequestDetailService;
    public function setUp():void
    {
        parent::setUp();
        $this->fileRequestDetailService = new FileRequestDetailService(
            new FileRequestDetailRepository()
        );
    }
    public function test_storeArrayfileIds()
    {
        $fileIds = [1,2,3];
        $response = $this->fileRequestDetailService->storeArrayfileIds([1,2,3],1);
        $this->assertEquals(count($response),count($fileIds));
        collect($response)->map(function($collectionResponse){
            $arrayResponse = $collectionResponse->toArray();
            $this->assertTrue(
                array_key_exists('file_id',$arrayResponse) &&
                array_key_exists('request_detail_id',$arrayResponse) &&
                array_key_exists('id',$arrayResponse)
            );
        });
        
    }

}
