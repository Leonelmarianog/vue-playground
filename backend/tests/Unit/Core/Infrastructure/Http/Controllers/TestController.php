<?php

namespace Tests\Unit\Core\Infrastructure\Http\Controllers;

use Exception;
use Modules\Core\Infrastructure\Http\Controllers\BaseController;

class TestController extends BaseController
{
    public function testSuccess()
    {
        return $this->success('Success', 200);
    }

    public function testError()
    {
        return $this->error(new Exception('Error'), 400, 'Error Message');
    }
}
