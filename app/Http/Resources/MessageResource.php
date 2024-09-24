<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user' =>  $this->whenLoaded('user'),
            'chat' => ChatResource::make($this->whenLoaded('chat')),
            'read_at' => [
                'relative' => $this->read_at?->diffForHumans(),
                'string' => $this->read_at?->toDateTimeString(),
                'special' => $this->read_at?->isoFormat('DD MMM, YYYY'),
            ],
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
        ];
    }
}
