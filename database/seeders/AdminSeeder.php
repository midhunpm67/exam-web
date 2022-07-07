<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
 
            [
                'name' => 'Midhun',
                'email' => 'midhun@gmail.com',
                'password' => Hash::make('midhun'),
                'usertype' => '1',
  
            ],
            [
                'name' => 'sini',
                'email' => 'sini@gmail.com',
                'password' => Hash::make('siniwac'),
                'usertype' => '2',
  
            ],
            [
                'name' => 'bibith',
                'email' => 'bibith@gmail.com',
                'password' => Hash::make('bibithwac'),
                'usertype' => '2',
  
            ],
        ]);
 
    }
}
