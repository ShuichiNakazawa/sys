<?php

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

        //$this->call(Question_sentencesTableSeeder::class);
        $this->call(Choice_sentencesTableSeeder::class);
        $this->call(Answer_sentencesTableSeeder::class);
        $this->call(DivisionsTableSeeder::class);
        $this->call(Individual_scoringsTableSeeder::class);

    }
}
