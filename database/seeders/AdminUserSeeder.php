<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class AdminUserSeeder extends Seeder
{

    public function run()
    {
        User::create([
            
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('123456'),
            'is_admin' =>'1',
        ]);
        User::create([
            
            'name' => 'User',
            'email' => 'user@domain.com',
            'password' => bcrypt('123456'),
            'is_admin' =>'0',
        ]);
    }
}
