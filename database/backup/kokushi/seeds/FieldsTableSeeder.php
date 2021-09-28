<?php

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('fields')->delete();
        
        \DB::table('fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'field_name' => '医療',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'field_name' => '情報処理',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
