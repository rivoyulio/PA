<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
        // [
        //     'nama_user' => 'Todi',
        //     'email' => 'todi@gmail.com',
        //     'password' => Hash::make('test1234'),
        //     'level' => 'dosen',
        // ],
        // [
        //     'nama_user' => 'Dosen',
        //     'email' => 'dosen@gmail.com',
        //     'password' => Hash::make('test1234'),
        //     'level' => 'dosen',
        // ],
        [
            'nama_user' => 'Kaprodi 2',
            'email' => 'kaprodi2@gmail.com',
            'password' => Hash::make('test1234'),
            'level' => 'kaprodi',
        ],
        // [
        //     'nama_user' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('test1234'),
        //     'level' => 'admin',
        // ]
    );
    }
}
