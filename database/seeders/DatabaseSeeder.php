<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $faker = Faker\Factory::create();

        for($i = 0; $i < 25; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => 'sss',
                'created_at' => $faker->date,
                'updated_at' => $faker->date,
            ]);
        }
    }
}
