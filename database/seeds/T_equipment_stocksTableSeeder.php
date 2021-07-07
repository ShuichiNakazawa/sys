<?php

use Illuminate\Database\Seeder;

class T_equipment_stocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('t_equip_stocks')->delete();
        
        \DB::table('t_equip_stocks')->insert(array (

            0 => 
            array (
                'id'                =>  1,
                'equipment_id'      =>  1,
                'stock_quantity'    =>  21,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            1 => 
            array (
                'id'                =>  2,
                'equipment_id'      =>  2,
                'stock_quantity'    =>  22,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            2 => 
            array (
                'id'                =>  3,
                'equipment_id'      =>  3,
                'stock_quantity'    =>  23,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            3 => 
            array (
                'id'                =>  4,
                'equipment_id'      =>  4,
                'stock_quantity'    =>  24,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            4 => 
            array (
                'id'                =>  5,
                'equipment_id'      =>  5,
                'stock_quantity'    =>  25,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            5 => 
            array (
                'id'                =>  6,
                'equipment_id'      =>  6,
                'stock_quantity'    =>  26,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            6 => 
            array (
                'id'                =>  7,
                'equipment_id'      =>  7,
                'stock_quantity'    =>  27,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),

            7 => 
            array (
                'id'                =>  8,
                'equipment_id'      =>  8,
                'stock_quantity'    =>  28,
                'created_at'    => '2021-07-03 07:38:56',
                'updated_at'    => NULL,
            ),
        ));
    }
}
