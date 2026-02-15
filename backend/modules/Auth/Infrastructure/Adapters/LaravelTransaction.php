<?php

namespace Modules\Auth\Infrastructure\Adapters;

use Closure;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Domain\Ports\TransactionInterface;

class LaravelTransaction implements TransactionInterface
{
    /**
     * {@inheritDoc}
     */
    public function execute(Closure $callback): mixed
    {
        return DB::transaction($callback);
    }
}
