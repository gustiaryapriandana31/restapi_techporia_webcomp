<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'M. Gusti Arya Priandana',
            'username' => 'aryaaja',
            'email' => 'priandanaarya01@gmail.com',
            'password' => bcrypt('password123'),
        ]);
        
        User::create([
            'name' => 'Rihan Naufaldihanif',
            'username' => 'rihanaja',
            'email' => 'rihannh@gmail.com',
            'password' => bcrypt('testing123'),
        ]);
        
        User::create([
            'name' => 'Aisha Nuraini',
            'username' => 'aishaaja',
            'email' => 'aishaais@gmail.com',
            'password' => bcrypt('introduce123'),
        ]);
    }
}