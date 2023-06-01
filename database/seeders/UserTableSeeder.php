<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'CMD',
            'last_name' => 'TECH',
            'status' => 1,
            'role_id' => 1,
            'email' => 'info@cmdtech.com.tr',
            'password' => Hash::make('51dr51dr69dr09Dr'),
        ]);
    }
}
