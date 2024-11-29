<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAchievementRequest extends FormRequest
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
            'name' => 'required|string',
            'date_awarded' => 'required|date',
            'student_id' => 'required|exists:students,id',
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
            'name.required' => 'Nama pencapaian tidak boleh kosong',
            'name.string' => 'Nama pencapaian harus berupa teks',
            'date_awarded.required' => 'Tanggal diberikan tidak boleh kosong',
            'date_awarded.date' => 'Tanggal diberikan harus berupa tanggal',
            'student_id.required' => 'Mahasiswa tidak boleh kosong',
            'student_id.exists' => 'Mmahasiswa tidak valid',
        ];
    }
}
