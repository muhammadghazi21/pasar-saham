<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Company::factory()->create([
            'user_id' => 2,
            'slug' => 'BMI',
            'name' => 'Burma Motor Industries',
            'net_income' => '300000000',
            'dividend' => '10000000',
            'assets' => '800000000',
            'debt' => '200000000',
        ]);

        Company::factory()->create([
            'user_id' => 3,
            'slug' => 'MPT',
            'name' => 'Miu Posts and Telecommunications',
            'net_income' => '200000000',
            'dividend' => '18000000',
            'assets' => '800000000',
            'debt' => '1000000',
        ]);

        Company::factory()->create([
            'user_id' => 4,
            'slug' => 'UTY',
            'name' => 'Union of Transport and Yachts',
            'net_income' => '160000000',
            'dividend' => '12000000',
            'assets' => '770000000',
            'debt' => '23000000',
        ]);

        Company::factory()->create([
            'user_id' => 5,
            'slug' => 'ZTT',
            'name' => 'Zawgyi Telecommunications and Technology',
            'net_income' => '100000000',
            'dividend' => '10000000',
            'assets' => '670000000',
            'debt' => '130000000',
        ]);
    }
}
