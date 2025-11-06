<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'User Init',
            'email' => 'userinit@gmail.com',
            'password' => bcrypt('7hDwzdAXrpTqmcf'),
            'curp' => 'CURP00000000000000',
            'phone' => '1234567890',
            'address' => 'Calle Principal 123'
        ])->assignRole('Doctor');
    }
}
