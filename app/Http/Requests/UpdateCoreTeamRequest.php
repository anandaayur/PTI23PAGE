<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoreTeamRequest extends FormRequest
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
            'position' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:1|unique:core_teams,order,' . $this->route('core_team')->id,
            'student_id' => 'nullable|exists:students,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'position.required' => 'Posisi wajib diisi.',
            'position.string' => 'Posisi harus berupa string.',
            'position.max' => 'Posisi tidak boleh melebihi 255 karakter.',
            'order.required' => 'Urutan wajib diisi.',
            'order.integer' => 'Urutan harus berupa angka.',
            'order.min' => 'Urutan harus lebih besar dari 0.',
            'order.unique' => 'Urutan sudah digunakan.',
            'student_id.exists' => 'Mahasiswa tidak valid.',
        ];
    }
}
