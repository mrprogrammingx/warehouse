<?php

namespace App\Services;

use App\Http\Livewire\FileDownload;
use App\Repositories\FileRepository;
use App\Repositories\FileRequestDetailRepository;
use App\Repositories\FilesCategoryRepository;
use App\Services\Globals\CryptService;
use App\Services\Globals\ResponsesService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;


class FileService
{
    protected $fileRepository, $filesCategoryRepository, $fileDownloadLivewire, $fileRequestDetailRepository;
    public function __construct(FileRepository $fileRepository, FilesCategoryRepository $filesCategoryRepository)
    {
        $this->fileRepository = $fileRepository;
        $this->filesCategoryRepository = $filesCategoryRepository;
        $this->fileRequestDetailRepository = new fileRequestDetailRepository();
        $this->fileDownloadLivewire = new FileDownload();
    }

    public function getAll()
    {
        return ResponsesService::success($this->fileRepository->getAll());
    }

    public function store(array $data)
    {
        return ResponsesService::success($this->fileRepository->store($data));
    }

    public function delete(int $id)
    {
        return ($this->fileIsInFileResquestDetailsTable($id)) ? ResponsesService::error(null, "It is possible to delete the file before registration!") : ResponsesService::success($this->fileRepository->delete($id));
    }

    public function update(array $data)
    {
        return ResponsesService::success($this->fileRepository->update($data));
    }

    public function storeFileInStorage(array $data)
    {
        $result['url'] = $data['file']->store($data['localRoute']);
        $result['file'] = '';
        return $result;
    }

    public function storeFileInStorageAndFilesTable(array $data)
    {
        $data['localRoute'] = $this->filesCategoryRepository->getById($data['filesCategory_id'])->link;
        $data['user_id'] = UserService::getUserId();
        $result = array_replace($data, $this->storeFileInStorage($data));
        return ResponsesService::success($this->fileRepository->store($result));
    }

    public function download(array $data)
    {
        $path = $this->createPathNameForAppStorage($this->fileRepository->getById($data['fileId'])->url);
        $storagePath = storage_path($path);

        if (File::exists($storagePath) && !is_dir($storagePath)) {
            return ResponsesService::success($this->fileDownloadLivewire->export($path, $this->createNameForDownload($path)));
        } else {
            var_dump('NO Such File Exists In :' . $path);
        }
    }

    public function createNameForDownload($path)
    {
        $extension = pathinfo(storage_path($path), PATHINFO_EXTENSION);
        return now() . ' - UploadedFile.' . $extension;
    }

    public function createPathNameForAppStorage($path)
    {
        $appStoragePath = 'app/';
        return $appStoragePath . $path;
    }

    public function show(array $data)
    {
        $path = $this->createPathNameForAppStorage($this->fileRepository->getById($data['fileId'])->url);
        $storagePath = storage_path($path);

        if (File::exists($storagePath) && !is_dir($storagePath)) {
            return ResponsesService::success($this->fileDownloadLivewire->show($path));
        } else {
            var_dump('NO Such File Exists In:' . $path);
        }
    }

    public function fileIsInFileResquestDetailsTable(int $id)
    {
        return $this->fileRequestDetailRepository->fileIdExist($id);
    }
}
