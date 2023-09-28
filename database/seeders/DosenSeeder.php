<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'id_user' => '5',
            'nip' => '12345',
            'nama_dosen' => 'Todi',
            'jabatan' => 'Dosen',
            'tempat_lahir' => '',
            'tgl_lahir' => '',
            'alamat' => '',
            'notelp' => '0811122334455',
        ]);
    }
}
