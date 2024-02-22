<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Task $this */
        return [
            'id'           => $this->id,
            'user'         => new UserResource($this->user),
            'title'        => $this->title,
            'description'  => $this->description,
            'completed_at' => $this->completed_at->toDateTimeString(),
            'created_at'   => $this->created_at->toDateTimeString(),
        ];
    }
}
