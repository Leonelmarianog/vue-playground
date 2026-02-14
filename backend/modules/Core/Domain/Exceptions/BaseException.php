<?php

namespace Modules\Core\Domain\Exceptions;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{
    protected int $statusCode = 500;

    public function __construct(
        string $message = 'An unexpected error occurred',
        int $statusCode = 500,
        ?Throwable $previous = null
    ) {
        $this->statusCode = $statusCode;
        parent::__construct($message, 0, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
