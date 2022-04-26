<?php

namespace Database\Seeds;
//namespace Database\Seeders;

use Illuminate\Database\Seeder;
//use database\seeds;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 外部キー制約　無効化
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        //$this->call(ReservationsTableSeeder::class);            // 予約
        
        //$this->call(FieldsTableSeeder::class);                  // 大分類
        //$this->call(SubjectsTableSeeder::class);                // 科目名
        $this->call(TitlesTableSeeder::class);                  // 問題タイトル

        $this->call(QuestionSentencesTableSeeder::class);       // 問題文
        $this->call(ChoiceSentencesTableSeeder::class);         // 選択肢文
        $this->call(AnswerSentencesTableSeeder::class);         // 正答文
        //$this->call(DivisionsTableSeeder::class);               // 分野
        //$this->call(IndividualScoringsTableSeeder::class);	  // 個人得点
        $this->call(SubjectGroupsTableSeeder::class);           // 科目グループ

        /*
	    // Stripe ECサイトサンプル
	    $this->call(ProductSeeder::class);			// 商品

        //$this->call(Book_oneweeksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(M_deptsTableSeeder::class);
        $this->call(M_equipmentsTableSeeder::class);
        $this->call(T_equipment_tagsTableSeeder::class);
        $this->call(T_equipment_stocksTableSeeder::class);
        */
        

        //$this->call(Musatra_commentsTableSeeder::class);
        //$this->call(Musatra_filesTableSeeder::class);

        // 外部キー制約　有効化
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
