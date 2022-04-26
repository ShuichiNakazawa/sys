<?php

use Illuminate\Database\Seeder;

class Musatra_commentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('musatra_comments')->delete();
        
        \DB::table('musatra_comments')->insert(array (
            0 => 
            array (
                'id' => '1',
                'title'    =>  'テストタイトル１',
                'comment'    => '＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊＊テストコメント１＊',
                'created_at' => '2021-07-22 22:31:56',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => '2',
                'title'    =>  'テストタイトル２',
                'comment'    => '＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊＊テストコメント２＊',
                'created_at' => '2021-07-22 22:31:56',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => '3',
                'title'    =>  'テストタイトル３',
                'comment'    => '＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊＊テストコメント３＊',
                'created_at' => '2021-07-22 22:31:56',
                'updated_at' => NULL,
            ),
        ));
    }
}
