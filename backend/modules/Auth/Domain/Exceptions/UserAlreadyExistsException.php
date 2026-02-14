<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Domain\Exceptions\DomainException;

class UserAlreadyExistsException extends DomainException
{
    public function __construct($message = 'User already exists.', $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
    }
}
