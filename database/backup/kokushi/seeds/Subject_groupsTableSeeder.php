<?php

use Illuminate\Database\Seeder;

class Subject_groupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('subject_groups')->delete();

        \DB::table('subject_groups')->insert( array(
            0 =>
            array (
                'id'                        =>  1,
                'subject_group_name'        =>  '医療',
                'sight_key'                 =>  'origin',
            ),

            1 =>
            array (
                'id'                        =>  2,
                'subject_group_name'        =>  '情報処理',
                'sight_key'                 =>  'origin',
            ),
        ));
    }
}
