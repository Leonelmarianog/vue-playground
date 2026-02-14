<?php

namespace Modules\Core\Infrastructure\Http\Controllers;

use Illuminate\Routing\Controller as LaravelController;
use Modules\Core\Infrastructure\Http\Traits\ApiResponses;

abstract class BaseController extends LaravelController
{
    use ApiResponses;
}
