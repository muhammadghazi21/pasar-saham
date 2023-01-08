<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dates = ['2022-12-27', '2022-12-28', '2022-12-29', '2022-12-30', '2022-12-31', '2023-1-1', '2023-1-2', '2023-1-3', '2023-1-4'];
        $transactions = [];

        for ($j = 0; $j < 1; $j++) {
            for ($i = 1; $i <= 3; $i++) {
                foreach ($dates as $date) {
                    $price = round(rand(2500, 5000) / 100) * 100;
                    $transaction = [
                        'user_id' => rand(6, 10),
                        'company_id' => $i,
                        'amount' => rand(100, 4000),
                        'price' => $price,
                        'tax' => 0,
                        'type' => 'buy',
                        'date' => $date
                    ];


                    if ($transaction['type'] == 'buy') {
                        $transaction['tax'] = $transaction['price'] * $transaction['amount'] * 0.01;
                    }
                    $transactions[] = $transaction;

                    $sell_transaction = $transaction;
                    $sell_transaction['type'] = 'sell';
                    $sell_transaction['tax'] = 0;
                    $transactions[] = $sell_transaction;
                }
            }
        }

        for ($j = 0; $j < 10; $j++) {
            $price = round(rand(2500, 4900) / 100) * 100;
            $transaction = [
                'user_id' => rand(6, 10),
                'company_id' => rand(1, 4),
                'amount' => rand(100, 4000),
                'price' => $price,
                'tax' => 0,
                'type' => 'buy',
                'date' => $dates[rand(0, 8)]
            ];


            if ($transaction['type'] == 'buy') {
                $transaction['tax'] = $transaction['price'] * $transaction['amount'] * 0.01;
            }
            $transactions[] = $transaction;

            $sell_transaction = $transaction;
            $sell_transaction['type'] = 'sell';
            $sell_transaction['tax'] = 0;
            $transactions[] = $sell_transaction;
        }

        for ($j = 0; $j < 6; $j++) {
            $price = round(rand(2500, 4900) / 100) * 100;
            $transaction = [
                'user_id' => rand(6, 10),
                'company_id' => rand(1, 4),
                'amount' => rand(100, 4000),
                'price' => $price,
                'tax' => 0,
                'type' => 'buy',
                'date' => $dates[rand(7, 8)]
            ];


            if ($transaction['type'] == 'buy') {
                $transaction['tax'] = $transaction['price'] * $transaction['amount'] * 0.01;
            }
            $transactions[] = $transaction;

            $sell_transaction = $transaction;
            $sell_transaction['type'] = 'sell';
            $sell_transaction['tax'] = 0;
            $transactions[] = $sell_transaction;
        }
        // print_r($transactions);
        Transaction::upsert($transactions, ['user_id', 'company_id', 'amount', 'price', 'tax', 'type', 'date']);
    }
}
