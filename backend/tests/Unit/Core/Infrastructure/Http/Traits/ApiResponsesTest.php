<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Config;
use Modules\Core\Infrastructure\Http\Traits\ApiResponses;

// Anonymous class to use the trait
$classWithTrait = new class
{
    use ApiResponses;
};

describe('ApiResponses Trait', function () use ($classWithTrait) {
    it('returns a success response', function () use ($classWithTrait) {
        $message = 'Success message';
        $statusCode = 200;
        $data = ['id' => 1];

        $response = $classWithTrait->success($message, $statusCode, $data);
        expect($response)->toBeInstanceOf(JsonResponse::class);

        $content = json_decode($response->getContent(), true);
        expect($content)->toBe([
            'success' => true,
            'status' => $statusCode,
            'message' => $message,
            'data' => $data,
        ]);
    });

    it('returns an error response without debug info when app.debug is false', function () use ($classWithTrait) {
        Config::set('app.debug', false);

        $exception = new Exception('Test exception', 500);
        $message = 'Error message';
        $statusCode = 400;
        $extra = ['key' => 'value'];

        $response = $classWithTrait->error($exception, $statusCode, $message, $extra);
        expect($response)->toBeInstanceOf(JsonResponse::class);

        $content = json_decode($response->getContent(), true);
        expect($content['success'])->toBeFalse()
            ->and($content['status'])->toBe($statusCode)
            ->and($content['message'])->toBe($message)
            ->and($content['error'])->toHaveKeys(['type', 'message', 'code', 'timestamp', 'key'])
            ->and($content['error']['type'])->toBe('Exception')
            ->and($content['error']['message'])->toBe('Test exception')
            ->and($content['error']['code'])->toBe(500)
            ->and($content['error']['key'])->toBe('value')
            ->and($content)->not->toHaveKey('debug');
    });

    it('returns an error response with debug info when app.debug is true', function () use ($classWithTrait) {
        Config::set('app.debug', true);

        $exception = new Exception('Test exception', 500);
        $message = 'Error message';
        $statusCode = 500;

        $response = $classWithTrait->error($exception, $statusCode, $message);
        expect($response)->toBeInstanceOf(JsonResponse::class);

        $content = json_decode($response->getContent(), true);
        expect($content)->toHaveKey('debug')
            ->and($content['debug'])->toHaveKeys(['exception', 'file', 'line', 'trace'])
            ->and($content['debug']['exception'])->toBe(Exception::class);
    });
});
