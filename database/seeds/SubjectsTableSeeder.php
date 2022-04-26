<?php

//namespace Database\Seeders;
//namespace Database\Seeder;

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('subjects')->delete();
        
        \DB::table('subjects')->insert(array (
            0 => 
            array (
                'id' => 1,
                'subject_group_id' => 1,
                'subject_name' => '看護師',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'subject_group_id' => 1,
                'subject_name' => '保険師',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'subject_group_id' => 1,
                'subject_name' => '助産師',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'subject_group_id' => 1,
                'subject_name' => '臨床検査技師',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'subject_group_id' => 1,
                'subject_name' => '診療放射線技師',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'subject_group_id' => 1,
                'subject_name' => '作業療法士',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'subject_group_id' => 1,
                'subject_name' => '理学療法士',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'subject_group_id' => 1,
                'subject_name' => '視能訓練士',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'subject_group_id' => 1,
                'subject_name' => '柔道整復師',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 11,
                'subject_group_id' => 2,
                'subject_name' => '基本情報技術者',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 12,
                'subject_group_id' => 2,
                'subject_name' => '応用情報技術者',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 13,
                'subject_group_id' => 2,
                'subject_name' => 'ネットワークスペシャリスト',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 14,
                'subject_group_id' => 2,
                'subject_name' => 'ITストラテジスト',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 15,
                'subject_group_id' => 2,
                'subject_name' => 'システムアーキテクト',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 16,
                'subject_group_id' => 2,
                'subject_name' => 'ITサービスマネージャ',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 17,
                'subject_group_id' => 2,
                'subject_name' => '情報処理安全確保支援士',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 18,
                'subject_group_id' => 2,
                'subject_name' => 'プロジェクトマネージャ',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 19,
                'subject_group_id' => 2,
                'subject_name' => 'データベーススペシャリスト',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 20,
                'subject_group_id' => 2,
                'subject_name' => 'エンベデッドシステムスペシャリスト',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 21,
                'subject_group_id' => 2,
                'subject_name' => 'システム監査技術者',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 22,
                'subject_group_id' => 2,
                'subject_name' => '情報セキュリティマネジメント',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 23,
                'subject_group_id' => 2,
                'subject_name' => '高度区分共通',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}