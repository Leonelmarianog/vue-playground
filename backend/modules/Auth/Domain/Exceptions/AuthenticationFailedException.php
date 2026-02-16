<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Domain\Exceptions\DomainException;

class AuthenticationFailedException extends DomainException
{
    public function __construct($message = 'Authentication failed.', $statusCode = 401)
    {
        parent::__construct($message, $statusCode);
    }
}
