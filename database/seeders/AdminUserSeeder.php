<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'title'=>'Mr',
            'name' => 'Techinfini',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at'=>now(),
            'status'=>1,
            'is_admin'=>1
        ]);
    }
}
