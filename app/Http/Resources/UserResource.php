<?php

namespace App\Http\Resources;

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
        if (config('app.env') == 'local') {
            return  [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'avatar' => $this->avatar ? config('app.url') . '/storage/' . $this->avatar : null,
                'church' => $this->church ? new ChurchResource($this->church) : null,
                'role' => new RoleResource($this->role)
            ];
        } else {
            return  [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'avatar' => $this->avatar ? config('app.url') . '/public/storage/' . $this->avatar : null,
                'church' => $this->church ? new ChurchResource($this->church) : null,
                'role' => new RoleResource($this->role)
            ];
        }
    }
}
