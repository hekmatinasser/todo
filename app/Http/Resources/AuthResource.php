<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var User $user */
        $user = $this['user'];
        return [
            'token' => $this->when(isset($this['token']), $this['token']),
            'user'  => [
                'id'                    => $user->id,
                'first_name'            => $user->first_name,
                'last_name'             => $user->last_name,
                'has_photo'             => (bool)$user->photo,
                'avatar'                => $user->avatar,
                'email'                 => $user->email,
                'has_two_factor_secret' => (bool)$user->two_factor_secret,
                'status'                => $user->status->name,
                'created_at'            => $user->created_at->toDateTimeString(),
            ]
        ];
    }
}
