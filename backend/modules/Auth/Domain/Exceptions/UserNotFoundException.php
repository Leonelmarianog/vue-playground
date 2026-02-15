<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Domain\Exceptions\DomainException;

class UserNotFoundException extends DomainException
{
    public function __construct($message = 'User not found.', $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
    }
}
