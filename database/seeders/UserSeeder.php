<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@globaltronics.net',
            'password' => Hash::make('password'),
            'role_as' => 1,

        ]);
        DB::table('users')->insert([
            'name' => 'Manager Manager',
            'email' => 'manager@globaltronics.net',
            'password' => Hash::make('password'),
            'role_as' => 3,

        ]);
        DB::table('users')->insert([
            'name' => 'User User',
            'email' => 'user@globaltronics.net',
            'password' => Hash::make('password'),
            'role_as' => 0,

        ]);
    }
}
