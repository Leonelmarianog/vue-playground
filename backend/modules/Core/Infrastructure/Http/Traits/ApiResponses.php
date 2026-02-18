<?php

namespace Modules\Core\Infrastructure\Http\Traits;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiResponses
{
    /**
     * Return an HTTP success response.
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
     * Return an HTTP error response.
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

    /**
     * Return the type of the exception, e.g. "NotFoundHttpException"
     */
    private function getExceptionType(Throwable $exception): string
    {
        return basename(str_replace('\\', '/', get_class($exception)));
    }

    /**
     * Return specific error data for the HTTP response.
     */
    private function getErrorData(Throwable $exception): array
    {
        return [
            'type' => $this->getExceptionType($exception),
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'timestamp' => now()->toISOString(),
        ];
    }

    /**
     * Return specific debug data for the HTTP response.
     */
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
                    'file' => $trace['file'],
                    'line' => $trace['line'],
                    'function' => $trace['function'],
                ];
            })->toArray(),
        ];
    }
}
