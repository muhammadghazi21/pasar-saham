<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => bcrypt('admin'),
        ]);

        $user->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'Company',
            'email' => 'company@localhost',
            'password' => bcrypt('company'),
        ]);

        $user->assignRole('company');

        $user = User::factory()->create([
            'name' => 'Company2',
            'email' => 'company2@localhost',
            'password' => bcrypt('company2'),
        ]);

        $user->assignRole('company');

        $user = User::factory()->create([
            'name' => 'Company3',
            'email' => 'company3@localhost',
            'password' => bcrypt('company3'),
        ]);

        $user->assignRole('company');

        $user = User::factory()->create([
            'name' => 'Company4',
            'email' => 'company4@localhost',
            'password' => bcrypt('company4'),
        ]);

        $user->assignRole('company');

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@localhost',
            'password' => bcrypt('user'),
        ]);

        $user->assignRole('user');

        $user = User::factory()->create([
            'name' => 'User2',
            'email' => 'user2@localhost',
            'password' => bcrypt('user2'),
        ]);

        $user->assignRole('user');

        $user = User::factory()->create([
            'name' => 'User3',
            'email' => 'user3@localhost',
            'password' => bcrypt('user3'),
        ]);

        $user->assignRole('user');

        $user = User::factory()->create([
            'name' => 'User4',
            'email' => 'user4@localhost',
            'password' => bcrypt('user4'),
        ]);

        $user->assignRole('user');

        $user = User::factory()->create([
            'name' => 'User5',
            'email' => 'user5@localhost',
            'password' => bcrypt('user5'),
        ]);

        $user->assignRole('user');
    }
}
