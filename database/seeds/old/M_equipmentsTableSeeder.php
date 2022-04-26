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
                'm_dept_id'                   => 2,
                'name_of_equipment'         => 'ドライバー',
                'image_name'                =>  'image1.jpg',
                'notification_min_value'    =>  11,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            1 => 
            array (
                'id'                        =>  2,
                'm_dept_id'                   => 3,
                'name_of_equipment'         => 'ハンマー',
                'image_name'                =>  'image2.jpg',
                'notification_min_value'    =>  12,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            2 => 
            array (
                'id'                        =>  3,
                'm_dept_id'                   => 3,
                'name_of_equipment'         => 'パイプレンチ',
                'image_name'                =>  'image3.jpg',
                'notification_min_value'    =>  13,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            3 => 
            array (
                'id'                        =>  4,
                'm_dept_id'                   => 3,
                'name_of_equipment'         => 'シールテープ',
                'image_name'                =>  'image4.jpg',
                'notification_min_value'    =>  14,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            4 => 
            array (
                'id'                        =>  5,
                'm_dept_id'                   => 3,
                'name_of_equipment'         => 'グラインダー',
                'image_name'                =>  'image5.jpg',
                'notification_min_value'    =>  15,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            5 => 
            array (
                'id'                        =>  6,
                'm_dept_id'                   => 3,
                'name_of_equipment'         => 'グラインダー替え刃',
                'image_name'                =>  'image6.jpg',
                'notification_min_value'    =>  16,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            6 => 
            array (
                'id'                        =>  7,
                'm_dept_id'                   => 1,
                'name_of_equipment'         => 'テスト備品名',
                'image_name'                =>  'image7.jpg',
                'notification_min_value'    =>  11,
                'datetime_alert'            =>  '2021-07-01 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            7 => 
            array (
                'id'                        =>  8,
                'm_dept_id'                   => 1,
                'name_of_equipment'         => 'テスト備品名2',
                'image_name'                =>  'image8.jpg',
                'notification_min_value'    =>  12,
                'datetime_alert'            =>  '2021-07-02 07:38:56',
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

        ));
    }
}
