<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var User $this */
        return [
            'user'        => [
                'id'                    => $this->id,
                'first_name'            => $this->first_name,
                'last_name'             => $this->last_name,
                'has_photo'             => (bool)$this->photo,
                'avatar'                => $this->avatar,
                'email'                 => $this->email,
                'has_two_factor_secret' => (bool)$this->two_factor_secret,
                'status'                => $this->status->name,
                'created_at'            => $this->created_at->toDateTimeString(),
            ],
            'roles'       => $this->cacheRole(),
            'permissions' => array_map(fn($permission) => $permission['name'], $this->cachePermissions()),
        ];
    }
}
