<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelanggaranRequest extends FormRequest
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
            'id_mhs' => 'required|exists:mahasiswas,id_mhs',
            'pelanggaran' => 'required',
            'tanggal' => 'required',
            'id_semester' => 'required',
            'deskripsi' => 'required',
            'id_komdis' => 'required|exists:komdis,id_komdis'
        ];
    }

    public function message()
    {
        return [
            'id_mhs.required' => 'ID Mahasiswa harus diisi',
            'pelanggaran.required' => 'Pelanggaran harus diisi',
            'tanggal.required' => 'Tanggal harus diisi',
            'id_semester.required' => 'Semester harus diisi',
            'deskripsi.required' => 'Waktu harus diisi',
            'id_komdis.required' => 'Komdis harus diisi'
        ];
    }
}
