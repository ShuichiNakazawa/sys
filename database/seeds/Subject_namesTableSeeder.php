<?php

use Illuminate\Database\Seeder;

class Subject_namesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('subject_names')->delete();

        \DB::table('subject_names')->insert( array(
            0 =>
            array (
                'id'                =>  1,
                'field_id'          =>  1,
                'subject_name'      =>  '看護師',
                'sight_key'         =>  'origin',
            ),
    
            1 =>
            array (
                'id'                => 2,
                'field_id'          =>  1,
                'subject_name'      => '保険師',
                'sight_key'         => 'origin',
            ),
                2 =>
                array (
                    'id'            => 3,
                    'field_id'      =>  1,
                    'subject_name'  => '助産師',
                    'sight_key'     => 'origin',
                ),
                3 =>
                array (
                    'id'            => 4,
                    'field_id'      =>  1,
                    'subject_name'  => '臨床検査技師',
                    'sight_key'     => 'origin',
                ),
                4 =>
                array (
                    'id'            => 5,
                    'field_id'      =>  1,
                    'subject_name'  => '診療放射線技師',
                    'sight_key'     => 'origin',
                ),
                5 =>
                array (
                    'id'            => 6,
                    'field_id'      =>  1,
                    'subject_name'  => '作業療法士',
                    'sight_key'     => 'origin',
                ),
                6 =>
                array (
                    'id'            => 7,
                    'field_id'      =>  1,
                    'subject_name'  => '理学療法士',
                    'sight_key'     => 'origin',
                ),
                7 =>
                array (
                    'id'            => 8,
                    'field_id'      =>  1,
                    'subject_name'  => '視能訓練士',
                    'sight_key'     => 'origin',
                ),
                8 =>
                array (
                    'id'            => 9,
                    'field_id'      =>  1,
                    'subject_name'  => '柔道整復師',
                    'sight_key'     => 'origin',
                ),
    
                9 =>
                array (
                    'id'            => 11,
                    'field_id'      =>  2,
                    'subject_name'  => '基本情報技術者',
                    'sight_key'     => 'origin',
                ),
    
    
                10 =>
                array (
                    'id'            => 12,
                    'field_id'      =>  2,
                    'subject_name'  => '応用情報技術者',
                    'sight_key'     => 'origin',
                ),
    
                11 =>
                array (
                    'id'            => 13,
                    'field_id'      =>  2,
                    'subject_name'  => 'ネットワークスペシャリスト',
                    'sight_key'     => 'origin',
                ),
    
                12 =>
                array (
                    'id'            => 14,
                    'field_id'      =>  2,
                    'subject_name'  => 'ITストラテジスト',
                    'sight_key'     => 'origin',
                ),
    
                13 =>
                array (
                    'id'            => 15,
                    'field_id'      =>  2,
                    'subject_name'  => 'システムアーキテクト',
                    'sight_key'     => 'origin',
                ),
                14 =>
                array (
                    'id'            => 16,
                    'field_id'      =>  2,
                    'subject_name'  => 'ITサービスマネージャ',
                    'sight_key'     => 'origin',
                ),
    
                15 =>
                array (
                    'id'            => 17,
                    'field_id'      =>  2,
                    'subject_name'  => '情報処理安全確保支援士',
                    'sight_key'     => 'origin',
                ),
    
                16 =>
                array (
                    'id'            => 18,
                    'field_id'      =>  2,
                    'subject_name'  => 'プロジェクトマネージャ',
                    'sight_key'     => 'origin',
                ),
                17 =>
                array (
                    'id'            => 19,
                    'field_id'      =>  2,
                    'subject_name'  => 'データベーススペシャリスト',
                    'sight_key'     => 'origin',
                ),
    
                18 =>
                array (
                    'id'            => 20,
                    'field_id'      =>  2,
                    'subject_name'  => 'エンベデッドシステムスペシャリスト',
                    'sight_key'     => 'origin',
                ),
    
                19 =>
                array (
                    'id'            => 21,
                    'field_id'      =>  2,
                    'subject_name'  => 'システム監査技術者',
                    'sight_key'     => 'origin',
                ),
    
        ));


    }
}
