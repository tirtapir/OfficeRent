<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingTransactionRequest extends FormRequest
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
        return [
            // 'id' => 'required',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'started_at' => 'required|date',
            'office_space_id' => 'required',
            'total_amount' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'phone_number.required' => 'Nomor telepon harus diisi.',
            'started_at.required' => 'Tanggal booking harus diisi.',
            
        ];
    }
}