<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SPRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'sp_name' => 'required',
            'id_mhs' => 'required|exists:mahasiswas,id_mhs',
            'id_semester' => 'required|exists:semester,id_semester',
            'waktu_keterlambatan' => 'required'
        ];
    }

    public function message()
    {
        return [
            'sp_name.required' => 'Nama SP harus diisi',
            'id_mhs.required' => 'Harus memilih mahasiswa',
            'id_semester.required' => 'Harus memilih semester',
            'waktu_keterlambatan.required' => 'Harus mengisi waktu keterlambatan'
        ];
    }
}
