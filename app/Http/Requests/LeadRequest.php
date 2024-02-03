<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
        $emailRule = 'required|email|unique:leads,email';
        $phoneNumberRule = 'required|numeric|unique:leads,phone_number';

        // when update data, ignore unique email, phone_number, lead_number
        if (request()->isMethod('PATCH')) {
            $emailRule = 'required|email|unique:leads,email,' . $this->lead;
            $phoneNumberRule = 'required|numeric|unique:leads,phone_number,' . $this->lead;
        }

        return [
            'branch_id' => 'required|exists:branches,id',
            'status_id' => 'required|exists:statuses,id',
            'probability_id' => 'required|exists:probabilities,id',
            'type_id' => 'required|exists:types,id',
            'channel_id' => 'required|exists:channels,id',
            'media_id' => 'nullable|exists:media,id',
            'source_id' => 'nullable|exists:sources,id',
            'fullname' => 'required|string|min:3|max:255',
            'email' => $emailRule,
            'phone_number' => $phoneNumberRule,
            'address' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'company_name' => 'required|string',
            'notes' => 'nullable|string',
        ];
    }
}
