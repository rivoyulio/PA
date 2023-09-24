<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodi::create([
            'kode_prodi' => '1',
            'nama_prodi' => 'Manajemen',
            'jenjang' => 'S1',
        ]);
    }
}
