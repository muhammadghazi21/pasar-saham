<?php

namespace Database\Seeders;

use App\Models\Qna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Qna::upsert([
            [
                'user_id' => 2,
                'message' => 'Hello, I am a new user. I want to know how to use this website.',
                'type' => 'question',
            ], [
                'user_id' => 2,
                'message' => 'Hello, you can read the tutorial on the home page.',
                'type' => 'answer',
            ], [
                'user_id' => 2,
                'message' => 'Thank you for your help.',
                'type' => 'question',
            ], [
                'user_id' => 2,
                'message' => 'You are welcome.',
                'type' => 'answer',
            ]
        ], ['user_id'], ['message', 'type']);
    }
}
