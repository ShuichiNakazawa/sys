<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                //'id' => 7441,
                'name' => 'しゅう',
                'password' => Hash::make('tactics1'),                
                'email' => 'shu.nakazaw@gmail.com',
                'sight_key' => '',
                'account_id'    =>  'shuichi_nakazawa',
                'privilege_access' => 1,
                'dept_id' => 1,
                'created_at' => '2021-07-03 07:38:56',
                'updated_at' => NULL,
            ),

            1 => 
            array (
                'name' => 'ゲストユーザ',
                'password' => Hash::make('guest_user'),
                'email' => 'guest_user@gmail.com',
                'sight_key' => '',
                'account_id'    =>  'guest_user',
                'privilege_access' => 1,
                'dept_id' => 1,
                'created_at' => '2021-07-03 07:38:56',
                'updated_at' => NULL,
            ),
        ));
    }
}
