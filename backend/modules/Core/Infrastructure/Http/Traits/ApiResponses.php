<?php

namespace Modules\Core\Infrastructure\Http\Traits;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiResponses
{
    /**
     * Returns an HTTP success response.
     */
    public function success(
        string $message,
        int $statusCode,
        ?array $data = []
    ): JsonResponse {
        $response = [
            'success' => true,
            'status' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Returns an HTTP error response.
     */
    public function error(
        Throwable $exception,
        int $statusCode,
        string $message,
        ?array $extra = []
    ): JsonResponse {
        $errorData = $this->getErrorData($exception);
        $debugData = $this->getDebugData($exception);

        $error = [
            'error' => [
                ...$errorData,
                ...$extra,
            ],
            ...($debugData ? [
                'debug' => $debugData,
            ] : []),
        ];

        $response = [
            'success' => false,
            'status' => $statusCode,
            'message' => $message,
            ...$error,
        ];

        return response()->json($response, $statusCode);
    }

    private function getExceptionType(Throwable $exception): string
    {
        return basename(str_replace('\\', '/', get_class($exception)));
    }

    private function getErrorData(Throwable $exception): array
    {
        return [
            'type' => $this->getExceptionType($exception),
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'timestamp' => now()->toISOString(),
        ];
    }

    private function getDebugData(Throwable $exception): array
    {
        if (! config('app.debug')) {
            return [];
        }

        return [
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => collect($exception->getTrace())->take(10)->map(function ($trace) {
                return [
                    'file' => $trace['file'] ?? 'internal',
                    'line' => $trace['line'] ?? 'n/a',
                    'function' => $trace['function'] ?? 'n/a',
                ];
            })->toArray(),
        ];
    }
}
