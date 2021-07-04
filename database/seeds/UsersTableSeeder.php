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
                'name' => 'ゲストユーザ(総合管理者)',
                'login_id'    =>  'guest_user',
                'password' => Hash::make('guest_user'),
                'email' => 'guest_user@gmail.com',
                'sight_key' => '',
                'privilege_access' => 1,
                'm_dept_id' => 1,
                'created_at' => '2021-07-03 07:38:56',
                'updated_at' => NULL,
            ),

            1 => 
            array (
                'name' => 'ゲストユーザ（部門管理者）',
                'login_id'    =>  'guest_user2',
                'password' => Hash::make('guest_user2'),
                'email' => 'guest_user2@gmail.com',
                'sight_key' => '',
                'privilege_access' => 2,
                'm_dept_id' => 3,
                'created_at' => '2021-07-03 07:38:56',
                'updated_at' => NULL,
            ),

            2 => 
            array (
                'name' => 'ゲストユーザ（一般）',
                'login_id'    =>  'guest_user3',
                'password' => Hash::make('guest_user3'),
                'email' => 'guest_user3@gmail.com',
                'sight_key' => '',
                'privilege_access' => 3,
                'm_dept_id' => 3,
                'created_at' => '2021-07-03 07:38:56',
                'updated_at' => NULL,
            ),
        ));
    }
}
