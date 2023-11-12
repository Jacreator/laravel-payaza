<?php

namespace App\Service;

use App\Models\UserKeys;
use Illuminate\Support\Str;
use App\Service\BaseService;

class UserKeyService extends BaseService
{
    public function __construct()
    {
        $this->model = new UserKeys;
    }

    public function store($payload)
    {
        $payload['secret_value'] = Str::random(15);
        $payload['key_value'] = Str::random(16);
        $payload['secret'] = 'PA_PROD ' . encryptId($payload['secret_value']);
        $payload['key'] = 'PA_PROD ' . encryptId($payload['key_value']);

        return $this->model->create($payload);
    }
}
