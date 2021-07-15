<?php

use Illuminate\Database\Seeder;

class QuestionTitlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('question_titles')->delete();
        
        \DB::table('question_titles')->insert(array (
            0 => 
            array (
                'id' => 533,
                'subject_name_id' => 13,
                'title_id' => 402,
                'question_title' => '平成３０年度 春期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:50:21',
            ),
            1 => 
            array (
                'id' => 534,
                'subject_name_id' => 13,
                'title_id' => 422,
                'question_title' => '平成３０年度 秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:50:33',
            ),
            2 => 
            array (
                'id' => 535,
                'subject_name_id' => 13,
                'title_id' => 382,
                'question_title' => '平成２９年度 秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:50:46',
            ),
            3 => 
            array (
                'id' => 536,
                'subject_name_id' => 13,
                'title_id' => 362,
                'question_title' => '平成２９年度 春期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:50:58',
            ),
            4 => 
            array (
                'id' => 537,
                'subject_name_id' => 13,
                'title_id' => 322,
                'question_title' => '平成２８年度 春期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:51:15',
            ),
            5 => 
            array (
                'id' => 538,
                'subject_name_id' => 13,
                'title_id' => 342,
                'question_title' => '平成２８年度 秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:51:26',
            ),
            6 => 
            array (
                'id' => 539,
                'subject_name_id' => 13,
                'title_id' => 302,
                'question_title' => '平成２７年度 秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:51:38',
            ),
            7 => 
            array (
                'id' => 540,
                'subject_name_id' => 13,
                'title_id' => 282,
                'question_title' => '平成２７年度 春期 午前２',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => '2021-05-17 16:51:48',
            ),
            8 => 
            array (
                'id' => 549,
                'subject_name_id' => 11,
                'title_id' => 44,
                'question_title' => '平成３１年春期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 550,
                'subject_name_id' => 11,
                'title_id' => 40,
                'question_title' => '平成３０年春期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 551,
                'subject_name_id' => 11,
                'title_id' => 42,
                'question_title' => '平成３０年秋期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 552,
                'subject_name_id' => 11,
                'title_id' => 38,
                'question_title' => '平成２９年秋期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 553,
                'subject_name_id' => 11,
                'title_id' => 36,
                'question_title' => '平成２９年春期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 554,
                'subject_name_id' => 11,
                'title_id' => 32,
                'question_title' => '平成２８年春期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 555,
                'subject_name_id' => 11,
                'title_id' => 34,
                'question_title' => '平成２８年秋期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 556,
                'subject_name_id' => 22,
                'title_id' => 46,
                'question_title' => '令和元年 秋期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 557,
                'subject_name_id' => 22,
                'title_id' => 44,
                'question_title' => '平成３１年 春期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 558,
                'subject_name_id' => 22,
                'title_id' => 42,
                'question_title' => '平成３０年 秋期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 559,
                'subject_name_id' => 22,
                'title_id' => 40,
                'question_title' => '平成３０年 春期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 560,
                'subject_name_id' => 22,
                'title_id' => 38,
                'question_title' => '平成２９年 秋期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 561,
                'subject_name_id' => 22,
                'title_id' => 36,
                'question_title' => '平成２９年 春期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 562,
                'subject_name_id' => 22,
                'title_id' => 34,
                'question_title' => '平成２８年 秋期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 563,
                'subject_name_id' => 22,
                'title_id' => 32,
                'question_title' => '平成２８年 春期',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 564,
                'subject_name_id' => 1,
                'title_id' => 2,
                'question_title' => '平成２０年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 565,
                'subject_name_id' => 1,
                'title_id' => 1,
                'question_title' => '平成２０年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 566,
                'subject_name_id' => 2,
                'title_id' => 2,
                'question_title' => '平成２０年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 567,
                'subject_name_id' => 2,
                'title_id' => 1,
                'question_title' => '平成２０年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 568,
                'subject_name_id' => 1,
                'title_id' => 4,
                'question_title' => '平成２１年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 569,
                'subject_name_id' => 1,
                'title_id' => 3,
                'question_title' => '平成２１年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 570,
                'subject_name_id' => 1,
                'title_id' => 26,
                'question_title' => '令和２年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 571,
                'subject_name_id' => 1,
                'title_id' => 25,
                'question_title' => '令和２年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 572,
                'subject_name_id' => 1,
                'title_id' => 24,
                'question_title' => '平成３１年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 573,
                'subject_name_id' => 1,
                'title_id' => 23,
                'question_title' => '平成３１年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 574,
                'subject_name_id' => 1,
                'title_id' => 22,
                'question_title' => '平成３０年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 575,
                'subject_name_id' => 1,
                'title_id' => 21,
                'question_title' => '平成３０年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 576,
                'subject_name_id' => 1,
                'title_id' => 20,
                'question_title' => '平成２９年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 577,
                'subject_name_id' => 1,
                'title_id' => 19,
                'question_title' => '平成２９年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 578,
                'subject_name_id' => 1,
                'title_id' => 18,
                'question_title' => '平成２８年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 579,
                'subject_name_id' => 1,
                'title_id' => 17,
                'question_title' => '平成２８年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 580,
                'subject_name_id' => 1,
                'title_id' => 16,
                'question_title' => '平成２７年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 581,
                'subject_name_id' => 1,
                'title_id' => 15,
                'question_title' => '平成２７年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 582,
                'subject_name_id' => 1,
                'title_id' => 14,
                'question_title' => '平成２６年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 583,
                'subject_name_id' => 1,
                'title_id' => 13,
                'question_title' => '平成２６年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 584,
                'subject_name_id' => 1,
                'title_id' => 12,
                'question_title' => '平成２５年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 585,
                'subject_name_id' => 1,
                'title_id' => 11,
                'question_title' => '平成２５年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 586,
                'subject_name_id' => 1,
                'title_id' => 10,
                'question_title' => '平成２４年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 587,
                'subject_name_id' => 1,
                'title_id' => 9,
                'question_title' => '平成２４年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 588,
                'subject_name_id' => 1,
                'title_id' => 8,
                'question_title' => '平成２３年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 589,
                'subject_name_id' => 1,
                'title_id' => 7,
                'question_title' => '平成２３年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 590,
                'subject_name_id' => 1,
                'title_id' => 6,
                'question_title' => '平成２２年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 591,
                'subject_name_id' => 1,
                'title_id' => 5,
                'question_title' => '平成２２年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 592,
                'subject_name_id' => 4,
                'title_id' => 26,
                'question_title' => '令和２年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 593,
                'subject_name_id' => 4,
                'title_id' => 25,
                'question_title' => '令和２年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 594,
                'subject_name_id' => 4,
                'title_id' => 24,
                'question_title' => '平成３１年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 595,
                'subject_name_id' => 4,
                'title_id' => 23,
                'question_title' => '平成３１年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 596,
                'subject_name_id' => 4,
                'title_id' => 22,
                'question_title' => '平成３０年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 597,
                'subject_name_id' => 4,
                'title_id' => 21,
                'question_title' => '平成３０年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 598,
                'subject_name_id' => 11,
                'title_id' => 46,
                'question_title' => '令和元年秋期 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 599,
                'subject_name_id' => 2,
                'title_id' => 26,
                'question_title' => '令和２年 午前',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 600,
                'subject_name_id' => 2,
                'title_id' => 25,
                'question_title' => '令和２年 午後',
                'sight_key' => 'origin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 601,
                'subject_name_id' => 3,
                'title_id' => 26,
                'question_title' => '令和２年 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-04-30 16:45:09',
                'updated_at' => '2021-04-30 16:45:09',
            ),
            61 => 
            array (
                'id' => 602,
                'subject_name_id' => 3,
                'title_id' => 25,
                'question_title' => '令和２年 午後',
                'sight_key' => 'origin',
                'created_at' => '2021-04-30 16:45:18',
                'updated_at' => '2021-04-30 16:45:18',
            ),
            62 => 
            array (
                'id' => 603,
                'subject_name_id' => 1,
                'title_id' => 28,
                'question_title' => '令和３年 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-01 10:24:15',
                'updated_at' => '2021-05-01 10:24:15',
            ),
            63 => 
            array (
                'id' => 604,
                'subject_name_id' => 1,
                'title_id' => 27,
                'question_title' => '令和３年 午後',
                'sight_key' => 'origin',
                'created_at' => '2021-05-01 10:24:25',
                'updated_at' => '2021-05-01 10:24:25',
            ),
            64 => 
            array (
                'id' => 605,
                'subject_name_id' => 3,
                'title_id' => 28,
                'question_title' => '令和３年 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-01 14:52:41',
                'updated_at' => '2021-05-01 14:52:41',
            ),
            65 => 
            array (
                'id' => 606,
                'subject_name_id' => 3,
                'title_id' => 27,
                'question_title' => '令和３年 午後',
                'sight_key' => 'origin',
                'created_at' => '2021-05-01 14:53:00',
                'updated_at' => '2021-05-01 14:53:00',
            ),
            66 => 
            array (
                'id' => 607,
                'subject_name_id' => 2,
                'title_id' => 28,
                'question_title' => '令和３年 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-03 17:33:03',
                'updated_at' => '2021-05-03 17:33:03',
            ),
            67 => 
            array (
                'id' => 608,
                'subject_name_id' => 2,
                'title_id' => 27,
                'question_title' => '令和３年 午後',
                'sight_key' => 'origin',
                'created_at' => '2021-05-03 17:33:12',
                'updated_at' => '2021-05-03 17:33:12',
            ),
            68 => 
            array (
                'id' => 609,
                'subject_name_id' => 12,
                'title_id' => 46,
                'question_title' => '令和元年秋期 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:46:14',
                'updated_at' => '2021-05-17 16:46:14',
            ),
            69 => 
            array (
                'id' => 610,
                'subject_name_id' => 12,
                'title_id' => 44,
                'question_title' => '平成３１年春期 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:47:03',
                'updated_at' => '2021-05-17 16:47:03',
            ),
            70 => 
            array (
                'id' => 611,
                'subject_name_id' => 12,
                'title_id' => 42,
                'question_title' => '平成３０年秋期 午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:47:25',
                'updated_at' => '2021-05-17 16:47:25',
            ),
            71 => 
            array (
                'id' => 612,
                'subject_name_id' => 14,
                'title_id' => 462,
                'question_title' => '令和元年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:53:33',
                'updated_at' => '2021-05-17 16:53:33',
            ),
            72 => 
            array (
                'id' => 613,
                'subject_name_id' => 15,
                'title_id' => 462,
                'question_title' => '令和元年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:54:02',
                'updated_at' => '2021-05-17 16:54:02',
            ),
            73 => 
            array (
                'id' => 614,
                'subject_name_id' => 16,
                'title_id' => 462,
                'question_title' => '令和元年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:54:24',
                'updated_at' => '2021-05-17 16:54:24',
            ),
            74 => 
            array (
                'id' => 615,
                'subject_name_id' => 17,
                'title_id' => 422,
                'question_title' => '平成30年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:54:55',
                'updated_at' => '2021-05-17 16:54:55',
            ),
            75 => 
            array (
                'id' => 616,
                'subject_name_id' => 17,
                'title_id' => 442,
                'question_title' => '平成31年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:55:18',
                'updated_at' => '2021-05-17 16:55:18',
            ),
            76 => 
            array (
                'id' => 617,
                'subject_name_id' => 17,
                'title_id' => 462,
                'question_title' => '令和元年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:55:42',
                'updated_at' => '2021-05-17 16:55:42',
            ),
            77 => 
            array (
                'id' => 618,
                'subject_name_id' => 18,
                'title_id' => 442,
                'question_title' => '平成31年春期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:56:13',
                'updated_at' => '2021-05-17 16:56:13',
            ),
            78 => 
            array (
                'id' => 619,
                'subject_name_id' => 19,
                'title_id' => 442,
                'question_title' => '平成31年春期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:56:41',
                'updated_at' => '2021-05-17 16:56:41',
            ),
            79 => 
            array (
                'id' => 620,
                'subject_name_id' => 20,
                'title_id' => 442,
                'question_title' => '平成31年春期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:57:06',
                'updated_at' => '2021-05-17 16:57:06',
            ),
            80 => 
            array (
                'id' => 621,
                'subject_name_id' => 21,
                'title_id' => 442,
                'question_title' => '平成31年秋期 午前２',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:57:25',
                'updated_at' => '2021-05-17 16:57:25',
            ),
            81 => 
            array (
                'id' => 622,
                'subject_name_id' => 6,
                'title_id' => 28,
                'question_title' => '令和３年　午前',
                'sight_key' => 'origin',
                'created_at' => '2021-05-17 16:57:25',
                'updated_at' => '2021-05-17 16:57:25',
            ),
        ));
        
        
    }
}