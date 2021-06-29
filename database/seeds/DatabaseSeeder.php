<?php

//namespace Database\Seeds;
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
        //$this->call(ReservationsTableSeeder::class);            // 予約
        //$this->call(FieldsTableSeeder::class);                  // 大分類
        //$this->call(Subject_namesTableSeeder::class);           // 科目名
        //$this->call(QuestionTitlesTableSeeder::class);          // 問題タイトル

        //$this->call(QuestionSentencesTableSeeder::class);       // 問題文
        //$this->call(ChoiceSentencesTableSeeder::class);         // 選択肢文
        //$this->call(AnswerSentencesTableSeeder::class);         // 正答文
        //$this->call(DivisionsTableSeeder::class);               // 分野
        //$this->call(IndividualScoringsTableSeeder::class);	  // 個人得点

	    // Stripe ECサイトサンプル
	    //$this->call(ProductSeeder::class);			// 商品

        $this->call(Book_oneweeksTableSeeder::class);

    }
}
