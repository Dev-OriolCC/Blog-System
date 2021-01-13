<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREATE DEFAULT ADMIN
        $user = User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => 'administrador',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
