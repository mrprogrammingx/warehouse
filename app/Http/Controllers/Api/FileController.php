<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\DownloadRequest;
use App\Http\Requests\File\ShowRequest;
use App\Http\Requests\File\StoreRequest;
use App\Http\Requests\File\UpdateRequest;
use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    protected $fileService;
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }
    public function getAll()
    {
        $result = $this->fileService->getAll();

        return response()->json($result, $result['status']);
    }

    public function store(StoreRequest $request)
    {
        $result = $this->fileService->store($request->validated());

        return response()->json($result, $result['status']);
    }

    public function delete(Request $request)
    {
        $result = $this->fileService->delete($request->id);

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request)
    {
        $result = $this->fileService->update($request->validated());

        return response()->json($result, $result['status']);
    }

    public function storeFileInStorageAndFileTable(StoreRequest $request)
    {
        $result = $this->fileService->storeFileInStorageAndFilesTable($request->validated());

        return response()->json($result, $result['status']);
    }

    public function download(DownloadRequest $request)
    {
        $result = $this->fileService->download($request->validated());

        return $result['data']; //for download just send data
    }

    public function show(ShowRequest $request)
    {
        $result = $this->fileService->show($request->validated());

        return $result['data']; //for show just send data
    }
}
