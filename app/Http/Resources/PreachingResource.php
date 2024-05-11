<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PreachingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (config('app.env') == 'local') {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'audio_url' => $this->audio_url != null ? config('app.url') . '/storage/' . $this->audio_url : null,
                'preacher_name' => $this->preacher_name,
                'is_online' => $this->is_online,
                'church' => new ChurchResource($this->church)
            ];
        } else {
            return [
                'id' => $this->id,
                'title' => $this->title,
                'audio_url' => $this->audio_url != null ? config('app.url') . '/public/storage/' . $this->audio_url : null,
                'preacher_name' => $this->preacher_name,
                'is_online' => $this->is_online,
                'church' => new ChurchResource($this->church)
            ];
        }
    }
}
