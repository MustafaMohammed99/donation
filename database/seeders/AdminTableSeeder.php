<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Association;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Admin::create([
//            'name' => 'Mohammed ',
//            'email' => 'm@gmail.com',
//            'password' => Hash::make('password'),
//            'image_path' => '',
//        ]);
        Association::create([
            'name' => 'Mohammed ',
            'address' => 'gaza',
            'email' => 'rahma@gmail.com',
            'password' => Hash::make('password'),
            'image_path' => '',
        ]);


        Association::create([
            'name' => 'al_Aqsa ',
            'address' => 'aqsa',
            'email' => 'aqsa@gmail.com',
            'password' => Hash::make('password'),
            'image_path' => '',
        ]);
    }
}
