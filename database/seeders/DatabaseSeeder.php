<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\JamuSeeder;
use Database\Seeders\KategoriJamuSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Admin
        User::factory()->create([
            'name' => 'Admin Taneyan Jamu',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 1,
        ]);

        // Manager
        User::factory()->create([
            'name' => 'Manager Taneyan Jamu',
            'username' => 'manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('manager123'),
            'role' => 2,
        ]);

        $this->call([
            KategoriJamuSeeder::class,
            JamuSeeder::class,
            KomentarSeeder::class,
        ]);
    }
}
