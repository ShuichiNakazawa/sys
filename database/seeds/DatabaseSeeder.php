<?php

use Illuminate\Database\Seeder;

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

    }
}
