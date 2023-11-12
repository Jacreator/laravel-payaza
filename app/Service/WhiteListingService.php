<?php

namespace App\Service;

use App\Models\Whitelist;
use App\Service\BaseService;

class WhiteListingService extends BaseService {
    
    public function __construct() {
        $this->model = new Whitelist();
    }
}