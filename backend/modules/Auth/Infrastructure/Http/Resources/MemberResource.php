<?php

namespace Modules\Auth\Infrastructure\Http\Resources;

use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Domain\Entities\Member;

/**
 * @property-read Member $resource
 */
class MemberResource extends JsonResource
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
            'user_id' => $this->resource->userId(),
            'full_name' => $this->resource->fullName(),
            'email' => $this->resource->email(),
            'avatar_url' => $this->resource->avatarUrl(),
            'bio' => $this->resource->bio(),
            'created_at' => $this->resource->createdAt()?->format(DateTimeInterface::ATOM),
            'updated_at' => $this->resource->updatedAt()?->format(DateTimeInterface::ATOM),
            'deleted_at' => $this->resource->deletedAt()?->format(DateTimeInterface::ATOM),
        ];
    }
}
