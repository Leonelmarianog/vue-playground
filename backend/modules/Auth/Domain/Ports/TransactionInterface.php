<?php

namespace Modules\Auth\Domain\Ports;

use Closure;

interface TransactionInterface
{
    /**
     * Execute a callback within a database transaction.
     */
    public function execute(Closure $callback): mixed;
}
