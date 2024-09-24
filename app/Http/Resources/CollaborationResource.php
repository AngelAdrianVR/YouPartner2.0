<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollaborationResource extends JsonResource
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
            'price' => $this->price,
            'net_price' => $this->netPrice(),
            'tax' => $this->tax,
            'promise_date' => $this->promise_date?->isoFormat('DD MMM, YYYY'),
            'completed_date' => $this->completed_date?->isoFormat('DD MMM, YYYY'),
            'approved_at' => [
                'relative' => $this->approved_at?->diffForHumans(),
                'string' => $this->approved_at?->toDateTimeString(),
                'special' => $this->approved_at?->isoFormat('DD MMM, YYYY'),
            ],
            'canceled_at' => [
                'relative' => $this->canceled_at?->diffForHumans(),
                'string' => $this->canceled_at?->toDateTimeString(),
                'special' => $this->canceled_at?->isoFormat('DD MMM, YYYY'),
            ],
            'read_at' => [
                'relative' => $this->read_at?->diffForHumans(),
                'string' => $this->read_at?->toDateTimeString(),
                'special' => $this->read_at?->isoFormat('DD MMM, YYYY'),
            ],
            'payed_at' => [
                'relative' => $this->payed_at?->diffForHumans(),
                'string' => $this->payed_at?->toDateTimeString(),
                'special' => $this->payed_at?->isoFormat('DD MMM, YYYY'),
            ],
            'payment_released_at' => [
                'relative' => $this->payment_released_at?->diffForHumans(),
                'string' => $this->payment_released_at?->toDateTimeString(),
                'special' => $this->payment_released_at?->isoFormat('DD MMM, YYYY'),
            ],
            'cancel_reason' => $this->cancel_reason,
            'completed_comments' => $this->completed_comments,
            'user' =>  UserResource::make($this->whenLoaded('user')),
            'claim' =>  ClaimResource::make($this->whenLoaded('claim')),
            'homework' => HomeworkResource::make($this->whenLoaded('homework')),
            'rate' => RateResource::make($this->whenLoaded('rate')),
            'created_at' => [
                'relative' => $this->created_at?->diffForHumans(),
                'string' => $this->created_at?->toDateTimeString(),
                'special' => $this->created_at?->isoFormat('DD MMM, YYYY'),
            ],
            'status' => $this->status(),
            'media' => $this->getMedia()->all(),
            'bank_number' => $this->bank_number,
            'bank_name' => $this->bank_name,
        ];
    }
}
