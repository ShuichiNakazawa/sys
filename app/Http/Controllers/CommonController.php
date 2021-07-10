<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    /**
     * 科目IDを科目名英字略称へ変換
     */
    public function getShortName($subject_id){
        // 科目名略称（ディレクトリ名） 編集
        if($subject_id == 1){
          return 'nurse';
        } else if ($subject_id == 2){
          return 'phn';
        } else if ($subject_id == 3){
          return 'midwife';
        } else if ($subject_id == 4){
          return 'clt';
        } else if ($subject_id == 5){
          return 'rt';
        } else if ($subject_id == 6){
          return 'ort';
        } else if ($subject_id == 7){
          return 'ot';
        } else if ($subject_id == 8){
          return 'pt';
        } else if ($subject_id == 9){
          return 'jrt';
        } else if ($subject_id == 10){
          return '';
        } else if ($subject_id == 11){
          return 'fe';
        } else if ($subject_id == 12){
          return 'ap';
        } else if ($subject_id == 13){
          return 'nw';
        } else if ($subject_id == 14){
          return 'st';
        } else if ($subject_id == 15){
          return 'sa';
        } else if ($subject_id == 16){
          return 'sm';
        } else if ($subject_id == 17){
          return 'sc';
        } else if ($subject_id == 18){
          return 'pm';
        } else if ($subject_id == 19){
          return 'db';
        } else if ($subject_id == 20){
          return 'es';
        } else if ($subject_id == 21){
          return 'au';
        } else if ($subject_id == 22){
          return 'sg';
        } else if ($subject_id == 23){
          return 'up';
        }
      }
  
      /**
       * 科目IDを科目名漢字表記へ変換
       */
      public function getKanjiName($subject_id){
        // 科目名略称（ディレクトリ名） 編集
        if($subject_id == 1){
          return '看護師';
        } else if ($subject_id == 2){
          return '保険師';
        } else if ($subject_id == 3){
          return '助産師';
        } else if ($subject_id == 4){
          return '臨床検査技師';
        } else if ($subject_id == 5){
          return '診療放射線技師';
        } else if ($subject_id == 6){
          return '視能訓練士';
        } else if ($subject_id == 7){
          return '理学療法士';
        } else if ($subject_id == 8){
          return '作業療法士';
        } else if ($subject_id == 9){
          return '柔道整復師';
        } else if ($subject_id == 10){
          return '';
        } else if ($subject_id == 11){
          return '基本情報技術者';
        } else if ($subject_id == 12){
          return '応用情報技術者';
        } else if ($subject_id == 13){
          return 'ネットワークスペシャリスト';
        } else if ($subject_id == 14){
          return 'ITストラテジスト';
        } else if ($subject_id == 15){
          return 'システムアーキテクト';
        } else if ($subject_id == 16){
          return 'ITサービスマネージャ';
        } else if ($subject_id == 17){
          return '情報処理安全確保支援士';
        } else if ($subject_id == 18){
          return 'プロジェクトマネージャ';
        } else if ($subject_id == 19){
          return 'データベーススペシャリスト';
        } else if ($subject_id == 20){
          return 'エンベデッドシステムスペシャリスト';
        } else if ($subject_id == 21){
          return 'システム監査技術者';
        } else if ($subject_id == 22){
          return '情報セキュリティマネジメント';
        } else if ($subject_id == 23){
          return '高度区分共通';
        }
      }
}
