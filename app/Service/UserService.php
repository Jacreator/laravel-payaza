<?php

namespace App\Service;

use App\Models\User;
use App\Service\BaseService;
use Illuminate\Support\Str;

class UserService extends BaseService {

    public function __construct(){
        $this->model = new User();
    }

    public function store($payload) {
        $payload['password'] = md5($payload['password']);
        $accountNumber = Str::random(10);
        // while ($this->model->findByWhere('account_number', $accountNumber)) {
        //     $accountNumber = Str::random(10);
        // }
        $payload['account_number'] = $accountNumber;
        $payload['available_balance'] = '0';
        $payload['locked_fund'] = '0';
        return $this->model->create($payload);
    }
}