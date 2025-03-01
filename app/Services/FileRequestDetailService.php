<?php

namespace App\Services;

use App\Repositories\FileRequestDetailRepository;

class FileRequestDetailService
{
    protected $fileRequestDetailRepository;
    public function __construct(FileRequestDetailRepository $fileRequestDetailRepository)
    {
        $this->fileRequestDetailRepository = $fileRequestDetailRepository;
    }

    public function storeArrayfileIds(array $file_ids,int $requestDetail_id){
        $FileRequestDetail = [];
        foreach($file_ids as $fileId){
            $dataForFileRequestDetail['file_id'] = $fileId;
            $dataForFileRequestDetail['request_detail_id'] = $requestDetail_id;
            array_push($FileRequestDetail , $this->fileRequestDetailRepository->store($dataForFileRequestDetail));
        }
        return $FileRequestDetail;
    }
}
