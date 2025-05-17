<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Jamu;
use App\Models\User;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $jamuIds = Jamu::pluck('id_jamu')->toArray();
        $userIds = User::pluck('id')->toArray();

        // Generate 50 komentar
        for ($i = 0; $i < 50; $i++) {
            DB::table('komentar')->insert([
                'komentar' => $faker->sentence(),
                'rating' => $faker->numberBetween(3, 5),
                'id_jamu' => $faker->randomElement($jamuIds),
                'id_user' => $faker->randomElement($userIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
