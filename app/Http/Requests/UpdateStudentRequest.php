<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'nim' => 'nullable|string|max:255|unique:students,nim,' . $this->route('student')->id,
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'photo' => 'nullable|image',
            'lecturer_id' => 'nullable|exists:lecturers,id',
            'organization_ids' => 'nullable|array',
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
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'nim.string' => 'NIM harus berupa string.',
            'nim.max' => 'NIM tidak boleh lebih dari :max karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'birth_date.date' => 'Tanggal lahir harus berupa tanggal.',
            'phone.string' => 'Telepon harus berupa string.',
            'phone.max' => 'Telepon tidak boleh lebih dari :max karakter.',
            'email.email' => 'Email harus berupa email.',
            'email.max' => 'Email tidak boleh lebih dari :max karakter.',
            'instagram.string' => 'Instagram harus berupa string.',
            'instagram.max' => 'Instagram tidak boleh lebih dari :max karakter.',
            'linkedin.string' => 'LinkedIn harus berupa string.',
            'linkedin.max' => 'LinkedIn tidak boleh lebih dari :max karakter.',
            'github.string' => 'GitHub harus berupa string.',
            'github.max' => 'GitHub tidak boleh lebih dari :max karakter.',
            'photo.image' => 'Foto harus berupa gambar.',
            'lecturer_id.exists' => 'Dosen tidak ditemukan.',
            'organization_ids.array' => 'Organisasi harus berupa array.',
        ];
    }
}
