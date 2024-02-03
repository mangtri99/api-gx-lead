<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $nameRule = 'required|string|min:3|max:255';

        // when update data, ignore unique name
        if (request()->isMethod('PATCH')) {
            $nameRule = 'required|string|min:3|max:255|unique:media,name,' . $this->medium;
        }

        return [
            'name' => $nameRule,
            'description' => 'nullable|string|max:255',
            'channel_id' => 'required|exists:channels,id',
        ];
    }
}
