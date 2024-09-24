<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'comments' => 'required|string|max:191',
            'stars' => 'required|numeric|max:5|min:1',
            'collaboration_id' => 'required|numeric|exists:collaborations,id',
        ];
    }
}
