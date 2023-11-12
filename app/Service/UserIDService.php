<?php

namespace App\Service;

use App\Models\UserID;
use App\Service\BaseService;

class UserIDService extends BaseService
{
    public function __construct()
    {
        $this->model = new UserID();
    }

    public function store($payload)
    {
        $payload['pin'] = encryptId($payload['pin']);
        return $this->model->create($payload);
    }
}