<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChurchResource extends JsonResource
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
                'name' => $this->name,
                'abbreviation' => $this->abbreviation,
                'logo' =>  $this->logo != null ? config('app.url') . '/storage/' . $this->logo : null,
                'status' => $this->status,
                'user_id' => $this->user_id,

            ];
        } else {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'abbreviation' => $this->abbreviation,
                'logo' =>  $this->logo != null ? config('app.url') . '/public/storage/' . $this->logo : null,
                'status' => $this->status,
                'user_id' => $this->user_id,

            ];
        }
    }
}
