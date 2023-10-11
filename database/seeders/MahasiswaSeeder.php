<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::create([
            'nim' => '122122',
            'nama_mhs' => 'Rafid',
            'nama_panggilan' => 'rafid@gmail.com',
            'tempat_lahir' => Hash::make('test1234'),
            'tgl_lahir' => '14/01/01',
            'id_agama' => '1',
            'jekel' => '',
            'jmlh_saudara' => '',
            'anak_ke' => '',
            'no_hp' => '',
            'id_prodi' => '1',
            'password' => Hash::make('test1234'),
            'id_kelas' => '1',
        ]);
    }
}
