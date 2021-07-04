<?php

use Illuminate\Database\Seeder;

class M_equipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('m_equipments')->delete();
        
        \DB::table('m_equipments')->insert(array (
            0 => 
            array (
                'id'                        =>  1,
                'm_dept_id'                   => 1,
                'name_of_equipment'         => 'テスト備品名',
                'image_name'                =>  'image1.jpg',
                'notification_min_value'    =>  11,
                'datetime_alert'            =>  '2021-07-01 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            1 => 
            array (
                'id'                        =>  2,
                'm_dept_id'                   => 2,
                'name_of_equipment'         => 'テスト備品名2',
                'image_name'                =>  'image2.jpg',
                'notification_min_value'    =>  12,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),
        ));
    }
}
