<?php

namespace Modules\Auth\Domain\Ports;

use Closure;

interface TransactionInterface
{
    /**
     * Execute a callback within a database transaction.
     *
     * @param  Closure  $callback  The callback to execute within the transaction.
     * @return mixed The result of the callback execution.
     */
    public function execute(Closure $callback): mixed;
}
