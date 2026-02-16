<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Domain\Exceptions\DomainException;

class LogoutFailedException extends DomainException
{
    public function __construct(string $message = 'Logout failed.', int $statusCode = 500)
    {
        parent::__construct($message, $statusCode);
    }
}
