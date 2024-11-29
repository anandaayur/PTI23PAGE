<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:students,nim',
            'birth_date' => 'required|date',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'photo' => 'nullable|image',
            'lecturer_id' => 'required|exists:lecturers,id',
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
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'nim.required' => 'NIM harus diisi.',
            'nim.string' => 'NIM harus berupa string.',
            'nim.max' => 'NIM tidak boleh lebih dari :max karakter.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'birth_date.required' => 'Tanggal lahir harus diisi.',
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
            'lecturer_id.required' => 'Dosen harus diisi.',
            'lecturer_id.exists' => 'Dosen tidak ditemukan.',
        ];
    }
}
