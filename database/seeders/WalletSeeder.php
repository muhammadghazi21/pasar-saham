<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Wallet::upsert([
            [
                'user_id' => 1,
                'balance' => 40028000,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 2,
                'balance' => 2800000,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 3,
                'balance' => 40000,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 4,
                'balance' => 4000000000,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 5,
                'balance' => 40000,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 6,
                'balance' => 200000,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 7,
                'balance' => 40700,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 8,
                'balance' => 40800,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 9,
                'balance' => 40900,
            ],
        ], ['user_id'], ['balance']);

        Wallet::upsert([
            [
                'user_id' => 10,
                'balance' => 41000,
            ],
        ], ['user_id'], ['balance']);
    }
}
