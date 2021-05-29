<?php

//namespace Database\Seeds;
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use database\seeds;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReservationsTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        $this->call(Subject_namesTableSeeder::class);
        $this->call(Question_titlesTableSeeder::class);

        $this->call(QuestionSentencesTableSeeder::class);
        $this->call(ChoiceSentencesTableSeeder::class);
        $this->call(AnswerSentencesTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        //$this->call(IndividualScoringsTableSeeder::class);

    }
}
