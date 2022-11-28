<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Role;
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
        $role = new Role();
        $role->role_name = 'admin';
        $role->save();

        $user = new User();
        $user->user_name = 'gltstar';
        $user->role_id = $role->id;
    	$user->email = 'gltstar@hotmail.com';
    	$user->password = Hash::make('password123');
    	$user->save();
    }
}
