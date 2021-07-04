<?php

use Illuminate\Database\Seeder;

class T_equipment_tagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('t_equipment_tags')->delete();
        
        \DB::table('t_equipment_tags')->insert(array (
            0 => 
            array (
                'id'            =>  1,
                'm_equipment_id'  => 1,
                'name_of_tag'   => 'テスト備品名1のタグ１',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            1 => 
            array (
                'id'            =>  2,
                'm_equipment_id'  => 1,
                'name_of_tag'   => 'テスト備品名1のタグ２',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

        ));
    }
}
