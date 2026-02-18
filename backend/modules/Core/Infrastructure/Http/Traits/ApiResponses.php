<?php

namespace Modules\Core\Infrastructure\Http\Traits;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiResponses
{
    /**
     * Return an HTTP success response.
     *
     * @param  array<mixed>  $data
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
     *
     * @param  array<mixed>  $extra
     */
    public function error(
        Throwable $exception,
        int $statusCode,
        string $message,
        ?array $extra = []
    ): JsonResponse {
        $response = [
            'success' => false,
            'status' => $statusCode,
            'message' => $message,
            'error' => [
                ...$this->getErrorData($exception),
                ...$extra,
            ],
        ];

        if (config('app.debug')) {
            $response['debug'] = $this->getDebugData($exception);
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return specific error data from a given exception.
     *
     * @return array<string, string|int>
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
     * Return specific debug data from a given exception.
     *
     * @return array<string, string|int|array<int, array<string, string|int>>>
     */
    private function getDebugData(Throwable $exception): array
    {
        return [
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $this->getExceptionTraces($exception),
        ];
    }

    /**
     * Return the type of the exception, e.g. "NotFoundHttpException"
     */
    private function getExceptionType(Throwable $exception): string
    {
        return basename(str_replace('\\', '/', get_class($exception)));
    }

    /**
     * Return the stack trace of the exception.
     *
     * @return array<int, array<string, string|int>>
     */
    private function getExceptionTraces(Throwable $exception): array
    {
        return collect($exception->getTrace())
            ->take(10)
            ->toArray();
    }
}
