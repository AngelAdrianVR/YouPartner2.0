<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'academic_grade' => $this->academic_grade,
            'school_name' => $this->school_name,
            'state' => $this->state,
            'birthdate' => $this->birthdate->isoFormat('DD MMM, YYYY'),
            'profile_photo_url' => $this->profile_photo_url,
            'level' => $this->whenLoaded('level'),
            'active' => $this->active ? 'Si' : 'No',
            'description' => $this->description,
            'collaborations' => CollaborationResource::collection($this->whenLoaded('collaborations')),
            'homeworks' => HomeworkResource::collection($this->whenLoaded('homeworks')),
            'claims_by_user' => $this->claimsByUser(),
            'claims_to_user' => $this->claimsToUser(),
            'canceled_collaborations' => $this->canceledCollaborations(),
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
            'rate_average' => $this->getRateAverage() ?? 'Sin calificaciones',
            'chats' => ChatResource::collection($this->whenLoaded('chats')),
        ];
    }
}
