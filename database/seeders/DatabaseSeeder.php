<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Association;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
//         \App\Models\User::factory(10)->create();
         Association::factory(1000)->create();
//        factory(Association::class, 5000)->create();

//        $this->call([
//            AdminTableSeeder::class,
//        ]);

    }
}
