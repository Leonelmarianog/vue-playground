<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Core\Infrastructure\Http\Errors\ApiExceptionHandler;
use Tests\Unit\Core\Infrastructure\Http\Errors\NamedBaseException;

beforeEach(function () {
    $this->handler = new ApiExceptionHandler;
    $this->request = Mockery::mock(Request::class);
});

it('handles validation exceptions', function () {
    $validator = Validator::make(['field' => ''], ['field' => 'required']);
    $exception = new ValidationException($validator);

    $response = $this->handler->handle($exception, $this->request);

    $content = json_decode($response->getContent(), true);
    expect($content['success'])->toBeFalse()
        ->and($content['status'])->toBe(422)
        ->and($content['message'])->toBe('One or more validation errors occurred.')
        ->and($content['error']['validation_errors'])->toBe($exception->errors())
        ->and($content['error']['type'])->toBe('ValidationException');
});

it('handles base exceptions', function () {
    $exception = new NamedBaseException('Base Exception', 400);

    $response = $this->handler->handle($exception, $this->request);

    expect($response->getStatusCode())->toBe(400);

    $content = json_decode($response->getContent(), true);
    expect($content['success'])->toBeFalse()
        ->and($content['message'])->toBe('Base Exception')
        ->and($content['status'])->toBe(400)
        ->and($content['error']['type'])->toBe('NamedBaseException');
});

it('handles generic exceptions', function () {
    $exception = new Exception('Generic Exception');

    $response = $this->handler->handle($exception, $this->request);

    $content = json_decode($response->getContent(), true);
    expect($content['success'])->toBeFalse()
        ->and($content['message'])->toBe('Generic Exception')
        ->and($content['status'])->toBe(500)
        ->and($content['error']['type'])->toBe('Exception');
});

it('handles exceptions with getStatusCode method', function () {
    $exception = new class('Special error') extends Exception
    {
        public function getStatusCode(): int
        {
            return 418;
        }
    };

    $response = $this->handler->handle($exception, $this->request);

    expect($response->getStatusCode())->toBe(418);
});

it('uses default message when exception message is empty', function () {
    $exception = new Exception('');

    $response = $this->handler->handle($exception, $this->request);

    $content = json_decode($response->getContent(), true);
    expect($content['message'])->toBe('An unexpected error occurred');
});
