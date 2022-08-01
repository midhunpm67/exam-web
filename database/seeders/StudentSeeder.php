<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::insert([
 
            [
                'name' => 'student',
                'email' => 'student@gmail.com',
                'password' => Hash::make('student'),
                'usertype' => 3,
  
            ],
            [
                'name' => 'student1',
                'email' => 'student1@gmail.com',
                'password' => Hash::make('student1'),
                'usertype' => 3,
  
            ],
            [
                'name' => 'student2',
                'email' => 'student2@gmail.com',
                'password' => Hash::make('student2'),
                'usertype' => 3,
  
            ],
        ]);
    }
}
