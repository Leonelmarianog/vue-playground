<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Domain\Exceptions\DomainException;

final class LogoutFailedException extends DomainException
{
    public function __construct(string $message = 'Logout failed.', int $statusCode = 500)
    {
        parent::__construct($message, $statusCode);
    }
}
