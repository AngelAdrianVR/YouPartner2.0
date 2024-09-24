<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorReportResource extends JsonResource
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
            'subject' => $this->subject,
            'content'=> $this->content,
            'user'=> UserResource::make($this->whenLoaded('user')),
            'is_error'=> $this->is_error,
            'is_read'=> $this->is_read,
            'media' => $this->getMedia()->all(),
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
            'updated_at'=>$this->updated_at,
        ];
    }
}
