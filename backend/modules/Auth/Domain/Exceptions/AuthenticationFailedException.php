<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Domain\Exceptions\DomainException;

final class AuthenticationFailedException extends DomainException
{
    public function __construct(string $message = 'Authentication failed.', int $statusCode = 401)
    {
        parent::__construct($message, $statusCode);
    }
}
