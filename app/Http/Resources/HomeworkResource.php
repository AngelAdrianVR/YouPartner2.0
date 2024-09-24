<?php

namespace App\Http\Resources;

use App\Models\Collaboration;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeworkResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'limit_date' => $this->limit_date->isoFormat('DD MMM, YYYY'),
            'priority' => $this->priority,
            'user' =>  UserResource::make($this->whenLoaded('user')),
            'school_subject' => $this->whenLoaded('schoolSubject'),
            'collaborations' => CollaborationResource::collection($this->whenLoaded('collaborations')),
            'approved_collaboration' => CollaborationResource::make($this->approvedCollaboration()),
            'chats' => ChatResource::collection($this->whenLoaded('chats')),
            'media' => $this->getMedia()->all(),
            'status' => $this->status(),
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
        ];
    }
}
