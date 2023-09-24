<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'TI-01',
            'tahun_angkatan' => '2019',
            'jumlah' => '',
            'id_prodi' => '1',
            'id_dosen' => '1'
        ]);
    }
}
