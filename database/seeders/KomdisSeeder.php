<?php

namespace Database\Seeders;

use App\Models\komdis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomdisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        komdis::create([
            'nama_komdis' => 'andi'
        ]);
    }
}
