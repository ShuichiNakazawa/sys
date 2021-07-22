<?php

use Illuminate\Database\Seeder;

class Musatra_filesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('musatra_files')->delete();
        
        \DB::table('musatra_files')->insert(array (
            0 => 
            array (
                'id' => '1',
                'comment_id'    =>  1,
                'file_id'       =>  1,
                'file_name'     => 'test.jpg',
                'created_at'    => '2021-07-22 22:31:56',
                'updated_at'    => NULL,
            ),
            1 => 
            array (
                'id' => '2',
                'comment_id'    =>  1,
                'file_id'       =>  2,
                'file_name'     => 'test2.jpg',
                'created_at'    => '2021-07-22 22:31:56',
                'updated_at'    => NULL,
            ),
            2 => 
            array (
                'id' => '3',
                'comment_id'    =>  3,
                'file_id'       =>  1,
                'file_name'     => 'test3.jpg',
                'created_at'    => '2021-07-22 22:31:56',
                'updated_at'    => NULL,
            ),
        ));
    }
}
