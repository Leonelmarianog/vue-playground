<?php

namespace Modules\Core\Infrastructure\Http\Errors;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\Core\Domain\Exceptions\BaseException;
use Modules\Core\Infrastructure\Http\Traits\ApiResponses;
use Throwable;

final class ApiExceptionHandler
{
    use ApiResponses;

    /**
     * Map of exception classes to their handler methods.
     *
     * @var array<string, string>
     */
    private array $handlers = [
        ValidationException::class => 'handleValidationException',
        BaseException::class => 'handleBaseException',
    ];

    /**
     * Handle an exception.
     */
    public function handle(
        Throwable $exception,
        Request $request
    ): JsonResponse {
        foreach ($this->handlers as $exceptionClass => $handlerMethod) {
            if ($exception instanceof $exceptionClass) {
                return $this->$handlerMethod($exception, $request);
            }
        }

        return $this->handleDefault($exception, $request);
    }

    /**
     * Handle a validation exception.
     */
    private function handleValidationException(
        ValidationException $exception,
        Request $request
    ): JsonResponse {
        return $this->error(
            exception: $exception,
            statusCode: $exception->status,
            message: 'One or more validation errors occurred.',
            extra: ['validation_errors' => $exception->errors()]
        );
    }

    /**
     * Handle a base exception.
     */
    private function handleBaseException(
        BaseException $exception,
        Request $request
    ): JsonResponse {
        return $this->error(
            exception: $exception,
            statusCode: $exception->getStatusCode(),
            message: $exception->getMessage()
        );
    }

    /**
     * Handle a generic exception.
     */
    private function handleDefault(
        Throwable $exception,
        Request $request
    ): JsonResponse {
        return $this->error(
            exception: $exception,
            statusCode: method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500,
            message: $exception->getMessage() ?: 'An unexpected error occurred'
        );
    }
}
