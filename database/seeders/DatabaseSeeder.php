<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);

        // Untuk record berikutnya, silakan beri nilai berbeda pada nama, email, dan hp
        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopian4ji@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);


        #data kategori
        kategori::create([
    'nama_kategori' => 'Brownies',
    ]);
        kategori::create([
    'nama_kategori' => 'Combro',
    ]);
        Kategori::create([
    'nama_kategori' => 'Dawet',
    ]);
        Kategori::create([
    'nama_kategori' => 'Mochi',
    ]);
        Kategori::create([
    'nama_kategori' => 'Wingko',
    ]);
    }
}
