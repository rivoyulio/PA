<?php

namespace Database\Seeders;

use App\Models\PelanggaranCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriPelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PelanggaranCategory::create([
            'name' => 'Keterlambatan'
        ]);
    }
}
