<?php

//namespace Database\Seeders;

//use Illuminate\Database\Seeder;

class SubjectGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subject_groups')->delete();
        
        \DB::table('subject_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subject_group_name' => '医療',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'subject_group_name' => '情報処理',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}