<?php

namespace Modules\Auth\Infrastructure\Http\Resources;

use DateTimeInterface;
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
            'email_verified_at' => $this->resource->emailVerifiedAt()?->format(DateTimeInterface::ATOM),
            'created_at' => $this->resource->createdAt()?->format(DateTimeInterface::ATOM),
            'updated_at' => $this->resource->updatedAt()?->format(DateTimeInterface::ATOM),
            'deleted_at' => $this->resource->deletedAt()?->format(DateTimeInterface::ATOM),
        ];
    }
}
