<?php

namespace Modules\Auth\Infrastructure\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Application\DTOs\MemberDto;

/**
 * @property-read MemberDto $resource
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
            'id' => $this->resource->id,
            'full_name' => $this->resource->fullName,
            'email' => $this->resource->email,
            'avatar_url' => $this->resource->avatarUrl,
            'bio' => $this->resource->bio,
        ];
    }
}
