<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenderSeeder::class
        ]);
        User::create(['name' => 'Male']);
        
        $organisations = \App\Models\Organisation::factory(100)->create();

        foreach ($organisations as $item) {
        }

        // \App\Models\User::factory(10)->create();
    }
}
