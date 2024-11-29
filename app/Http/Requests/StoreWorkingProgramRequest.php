<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkingProgramRequest extends FormRequest
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
            'core_team_id' => 'required|exists:core_teams,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     * 
     * 
     * 
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'core_team_id.required' => 'Pengurus inti tidak boleh kosong',
            'core_team_id.exists' => 'Pengurus inti tidak valid',
            'name.required' => 'Nama program kerja tidak boleh kosong',
            'name.string' => 'Nama program kerja harus berupa teks',
            'name.max' => 'Nama program kerja tidak boleh lebih dari 255 karakter',
            'description.string' => 'Deskripsi program kerja harus berupa teks',
        ];
    }
}
