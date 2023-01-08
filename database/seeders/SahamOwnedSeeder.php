<?php

namespace Database\Seeders;

use App\Models\Saham_owned;
use Database\Factories\SahamOwnedFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SahamOwnedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Saham_owned::upsert([
            [
                'user_id' => 2,
                'company_id' => 1,
                'amount' => '599000',
                'price' => '2800'
            ], [
                'user_id' => 3,
                'company_id' => 2,
                'amount' => '800000',
                'price' => '3800'
            ], [
                'user_id' => 4,
                'company_id' => 3,
                'amount' => '1900000',
                'price' => '3400'
            ], [
                'user_id' => 5,
                'company_id' => 4,
                'amount' => '1200000',
                'price' => '3500'
            ], [
                'user_id' => 6,
                'company_id' => 1,
                'amount' => '1000',
                'price' => '2800'
            ], [
                'user_id' => 7,
                'company_id' => 3,
                'amount' => '100',
                'price' => '4000',
            ], [
                'user_id' => 8,
                'company_id' => 2,
                'amount' => '300',
                'price' => '4000',
            ], [
                'user_id' => 9,
                'company_id' => 4,
                'amount' => '20',
                'price' => '4000',
            ], [
                'user_id' => 10,
                'company_id' => 1,
                'amount' => '20',
                'price' => '4000',
            ]
        ], ['user_id', 'company_id'], ['amount', 'price']);
    }
}
