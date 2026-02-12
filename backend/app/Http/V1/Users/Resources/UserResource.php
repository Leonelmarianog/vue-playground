<?php

namespace App\Http\V1\Users\Resources;

use App\Domain\V1\Users\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
