<?php

use Illuminate\Http\JsonResponse;
use Modules\Core\Infrastructure\Http\Controllers\BaseController;
use Tests\Unit\Core\Infrastructure\Http\Controllers\TestController;

describe('BaseController', function () {
    it('is an abstract class and can be extended', function () {
        $controller = new TestController;
        expect($controller)->toBeInstanceOf(BaseController::class);
    });

    it('has access to ApiResponses trait methods', function () {
        $controller = new TestController;

        $successResponse = $controller->testSuccess();
        expect($successResponse)->toBeInstanceOf(JsonResponse::class)
            ->and($successResponse->getStatusCode())->toBe(200);

        $errorResponse = $controller->testError();
        expect($errorResponse)->toBeInstanceOf(JsonResponse::class)
            ->and($errorResponse->getStatusCode())->toBe(400);
    });
});
