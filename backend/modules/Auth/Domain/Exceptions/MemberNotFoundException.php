<?php

namespace Modules\Auth\Domain\Exceptions;

use Modules\Core\Application\Exceptions\ApplicationException;

class MemberNotFoundException extends ApplicationException
{
    public function __construct(string $message = 'Member not found.', int $statusCode = 404)
    {
        parent::__construct($message, $statusCode);
    }
}
