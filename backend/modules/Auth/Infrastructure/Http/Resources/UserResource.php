<?php

namespace Modules\Auth\Infrastructure\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Domain\Entities\User;

/**
 * @property-read User $resource
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id(),
            'first_name' => $this->resource->firstName(),
            'last_name' => $this->resource->lastName(),
            'full_name' => $this->resource->fullName(),
            'email' => $this->resource->email(),
            'email_verified_at' => $this->resource->emailVerifiedAt(),
            'created_at' => $this->resource->createdAt(),
            'updated_at' => $this->resource->updatedAt(),
            'deleted_at' => $this->resource->deletedAt(),
        ];
    }
}
