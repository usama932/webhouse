<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@webhouse.com',
            'password' => Hash::make('password'),
        ]);

        Package::create([
            'name' => 'Professional Website Package',
            'price' => '2000',
            'content' => 'Full Website Development Package',
        ]);

        Package::create([
            'name' => 'Professional Video Package',
            'price' => '750',
            'content' => 'Full Video Production Package',
        ]);
        Package::create([
            'name' => 'Professional Logo Design Package',
            'price' => '450',
            'content' => 'Full Logo Design Package',
        ]);
    }
}
