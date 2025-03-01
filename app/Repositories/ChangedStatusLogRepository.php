<?php

namespace App\Repositories;

use App\Models\ChangedStatusLog;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ChangedStatusLogRepository.
 */
class ChangedStatusLogRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return ChangedStatusLog::class;
    }

    public function store($data)
    {
        return $this->model()::create([
            'request_id' => $data['request_id'],
            'status_id' => $data['status_id'],
            'user_id' => $data['user_id']
        ]);
    }
}
