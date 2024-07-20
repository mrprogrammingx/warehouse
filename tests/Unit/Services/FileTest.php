<?php

namespace Tests\Unit\Services;

use App\Repositories\FileRepository;
use App\Repositories\FilesCategoryRepository;
use App\Services\FileService;
use Database\Factories\FileFactory;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileTest extends TestCase
{
    public FileService $fileService;
    public FileFactory $fileFactory;
    public function setUp(): void
    {
        parent::setUp();
        $this->fileFactory = new FileFactory();
        $this->fileService = new FileService(
            new FileRepository(),
            new FilesCategoryRepository()
        );
    }

    public function test_getAll(): void
    {
        $response = $this->fileService->getAll();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_store(): ?object
    {
        $response = $this->fileService->store($this->fileFactory->definition());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        return $response['data'];
    }

    public function test_delete(): void
    {
        $file = $this->test_store();
        $response = $this->fileService->delete($file->id);
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_update(): void
    {
        $file = $this->test_store();
        $response = $this->fileService->update($file->toArray());
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_storeFileInStorage(): void
    {
        $file = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'file' => $file,
            'localRoute' => '/',
        ];
        $response = $this->fileService->storeFileInStorage($data);
        $this->assertTrue(
            !empty($response['url']) &&
            is_string($response['url']) &&
            array_key_exists('file', $response)
        );
        Storage::assertExists($response['url']);
        Storage::delete($response['url']);
        Storage::assertMissing($response['url']);
    }

    public function test_storeFileInStorageAndFilesTable($delete = true): ?object
    {
        $file = UploadedFile::fake()->image('avatar.jpg');
        $data = [
            'file' => $file,
            'localRoute' => '/',
            'filesCategory_id' => 1,
        ];
        $response = $this->fileService->storeFileInStorageAndFilesTable($data);
        $result = $response['data']->toArray();
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
        $this->assertTrue(
            array_key_exists('filesCategory_id', $result) &&
            array_key_exists('name', $result) &&
            array_key_exists('url', $result) &&
            array_key_exists('file', $result) &&
            array_key_exists('user_id', $result) &&
            array_key_exists('description', $result) &&
            array_key_exists('id', $result)
        );
        Storage::assertExists($result['url']);
        if ($delete === true) {
            Storage::delete($result['url']);
            Storage::assertMissing($result['url']);
        }
        return $response['data'];
    }

    public function test_download():void
    {
        $file = $this->test_storeFileInStorageAndFilesTable($delete = false);
        $data = [
            'fileId' => $file->id,
        ];
        $response = $this->fileService->download($data);
        if ($delete === false) {
            Storage::delete($file->url);
            Storage::assertMissing($file->url);
        }
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_createNameForDownload()
    {
        $extension = 'jpg';
        $path = "/test.$extension";
        $response = $this->fileService->createNameForDownload($path);
        $this->assertStringContainsString($extension,$response);
        $this->assertGreaterThan(strlen(".$extension"),strlen($response));
    }

    public function test_createPathNameForAppStorage()
    {
        $extension = 'jpg';
        $path = "test.$extension";
        $response = $this->fileService->createPathNameForAppStorage($path);
        $this->assertGreaterThanOrEqual(strlen($path),strlen($response));
    }

    public function test_show():void
    {
        $file = $this->test_storeFileInStorageAndFilesTable($delete = false);
        $data = [
            'fileId' => $file->id,
        ];
        $response = $this->fileService->show($data);
        if ($delete === false) {
            Storage::delete($file->url);
            Storage::assertMissing($file->url);
        }
        $this->assertTrue($response['status'] >= 200 && $response['status'] < 300);
    }

    public function test_fileIsInFileResquestDetailsTable()
    {
        $response = $this->fileService->fileIsInFileResquestDetailsTable(rand(1,10));
        $this->assertIsBool($response);
    }

}