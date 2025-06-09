<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Alamat;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user
        $users = User::all();

        foreach ($users as $user) {
            // Anda bisa sesuaikan jumlah alamat per user di sini
            $jumlahAlamat = rand(1, 3);

            for ($i = 0; $i < $jumlahAlamat; $i++) {
                Alamat::create([
                    'alamat' => fake()->address(),
                    'id_user' => $user->id,
                ]);
            }
        }
    }
}
