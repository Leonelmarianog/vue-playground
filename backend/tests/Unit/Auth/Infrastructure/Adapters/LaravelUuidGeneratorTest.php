<?php

use Illuminate\Support\Str;
use Modules\Auth\Infrastructure\Adapters\LaravelUuidGenerator;

describe('LaravelUuidGenerator', function () {
    it('generates a valid UUID string', function () {
        $generator = new LaravelUuidGenerator;

        $uuid = $generator->generate();

        expect($uuid)->toBeString()
            ->and(Str::isUuid($uuid))->toBeTrue();
    });
});
