<?php

namespace Database\Seeders;

use App\Models\Saham_sale;
use Database\Factories\SahamSaleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SahamSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Saham_sale::upsert([
            [
                'user_id' => 2,
                'company_id' => 1,
                'amount' => '500',
                'price' => '2800'
            ], [
                'user_id' => 4,
                'company_id' => 3,
                'amount' => '8000',
                'price' => '3400'
            ], [
                'user_id' => 3,
                'company_id' => 2,
                'amount' => '800',
                'price' => '3800'
            ], [
                'user_id' => 5,
                'company_id' => 4,
                'amount' => '1200',
                'price' => '3500'

            ], [
                'user_id' => 6,
                'company_id' => 1,
                'amount' => '10',
                'price' => '3000'
            ], [
                'user_id' => 7,
                'company_id' => 3,
                'amount' => '50',
                'price' => '4000'
            ], [
                'user_id' => 8,
                'company_id' => 2,
                'amount' => '100',
                'price' => '4000'
            ], [
                'user_id' => 9,
                'company_id' => 4,
                'amount' => '8',
                'price' => '4000'
            ], [
                'user_id' => 10,
                'company_id' => 1,
                'amount' => '12',
                'price' => '4000'
            ]
        ], ['user_id', 'company_id'], ['amount', 'price']);
    }
}
