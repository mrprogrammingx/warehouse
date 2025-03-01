<?php

namespace App\Repositories;

use App\Models\RequestDetailsEditLog;
use App\Repositories\Globals\fieldRepository;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class RequestDetailsEditLogRepository.
 */
class RequestDetailsEditLogRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return RequestDetailsEditLog::class;
    }

    public function store(array $data)
    {
        return $this->model()::create(
            fieldRepository::tableFields($data, $table = 'request_details_edit_logs')
        );
    }
}
