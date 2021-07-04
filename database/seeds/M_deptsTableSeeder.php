<?php

use Illuminate\Database\Seeder;

class M_deptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('m_depts')->delete();
        
        \DB::table('m_depts')->insert(array (
            0 => 
            array (
                'id'            =>  1,
                'name_of_dept'  => 'テスト部門',
                'editor'        => 'テストユーザ',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            1 => 
            array (
                'id'            =>  2,
                'name_of_dept'  => '営業部',
                'editor'        => '営業部ユーザ１',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),
        ));
    
    }
}
