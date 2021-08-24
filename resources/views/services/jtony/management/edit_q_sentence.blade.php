<!-- resources/views/rooms/store_q_sentence.blade.php -->
@extends('layouts.app_ipquestion')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

  <div class="card-body store_question_sentence_outer">
    <h4>問題文 登録</h4>
    <br>

    科目グループ名：
    <input type="text" name="subject_group_id" value="{{ $subject_group_name }}" readonly>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    科目名：
    <input type="text" name="subject_id" value="{{ $subject_name }}" readonly>
    <br><br>

    <form enctype="multipart/form-data" action="{{ url('/management/edit_q_sentence') }}" method="POST">
      @csrf

      問題タイトル：　
      <input type="text" name="title_name" value="{{ $title_name }}" readonly>
      <br><br>

      問題番号：
      <input type="text" name="question_number" value="{{ $question_number }}" size="3" readonly>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      選択肢の数：
      <select name="number_of_choices" id="number_of_choices">
        {{-- 単純なループ --}}
        @for($choice_index = 4; $choice_index < 10; $choice_index++)
          @if($choice_index == $question_sentence->number_of_choices)
            <option value="{{ $choice_index }}" selected>{{ $choice_index }}</option>>
          @else
            <option value="{{ $choice_index }}">{{ $choice_index }}</option>>
          @endif
        @endfor
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      必須回答数：
      <select name="required_numOfAnswers">
        @for($answer_index = 1; $answer_index < 6; $answer_index++)
          @if($answer_index == $question_sentence->required_numOfAnswers)
            <option value="{{ $answer_index }}" selected>{{ $answer_index }}</option>  
          @else
            <option value="{{ $answer_index }}">{{ $answer_index }}</option>  
          @endif
        @endfor
      </select>
      <br><br>

      <table class="table table-striped task-table">
        <tbody>
          <tr>
            <td style="vertical-align: middle; width:90px;">
              問題文
            </td>
            <td colspan="2">
              <textarea style="valign: middle;" name="question_sentence" value="" cols="80" rows="2">{{ $question_sentence->question_sentence }}</textarea>
            </td>
          </tr>

          <tr>
            <td style="vertical-align: middle;" colspan="2">
              図表の有無
              <input type="radio" name="falg_graph_exists" class="radio_hide" id="flag_0" value="0" checked="checked">
              <label for="flag_0" class="btn-correct_answer" id="label_flag_0">無し</label>
              &nbsp;

              <input type="radio" name="falg_graph_exists" class="radio_hide" id="flag_1" value="1">
              <label for="flag_1" class="btn-correct_answer" id="label_flag_1">有り</label>
              &nbsp;&nbsp;&nbsp;

              <label class="image_item hide_item">画像</label>
              <input type="file" name="image" class="image_item hide_item">
            </td>


{{--
            <td>
              <img src="image/{{ $qsentence->image_name }}" width="100">
            </td>
--}}
          </tr>
          @php
            $choice_index = 1;    
          @endphp
          @foreach($choice_sentences as $choice_sentence)
            <tr>
              <td class="choiceItem_col1">
                選択肢{{ $choice_index }}
              </td>
              <td class="choiceItem_col2">
                <textarea name="choice{{ $choice_index }}" cols="80" rows="2">{{ $choice_sentence->choice_sentence }}</textarea>
              </td>
              <td class="choiceItem_col3">
                {{-- 正答配列に含まれるかどうかで、判定する --}}
                @php
                  $flag_correct = 0;
                @endphp
                @foreach($answer_sentences as $answer_sentence)
                  @if($choice_index == $answer_sentence->answer_sentence)
                    @php
                      $flag_correct = 1;
                    @endphp
                  @endif
                @endforeach

                @if( $flag_correct == 1)
                  <input type="checkbox" name="answer{{ $choice_index }}" id="answer{{ $choice_index }}" checked>
                @else
                  <input type="checkbox" name="answer{{ $choice_index }}" id="answer{{ $choice_index }}">
                @endif
                <label for="answer{{ $choice_index }}" class="btn-correct_answer">正答</label>
              </td>
            </tr>

            @php
              $choice_index++;
            @endphp
          @endforeach
        </tbody>
      </table>

      <input type="hidden" name="subject_name_id" value="{{ $subject_id }}">

      {{-- 正答ボタン押下時に、値を変更する必要がある --}}
      <input type="hidden" name="number_of_answers" id="hidden_numOfAns" value="{{ $question_sentence->number_of_answers }}">
      <input type="submit" value="修正">

    </form>
  </div>


<div class="listArea">
  <div class="innerList">
    <!-- TOP  -->
  </div>
</div>
@endsection

@section('script')
  <script type="module">
    $(function(){
      //
      //  選択肢数　変更時処理
      //
      $('#number_of_choices').change(function(){
        //選択肢の数 取得
        var numOfChoices  = $('#number_of_choices option:selected').val();

        // ループ（選択肢５～９）
        for(var i=5; i<10; i++){

          // ID名 編集
          var className = '.choice' + i;
          var hide  = 'choice_hide';

          // 表示判定
          if(i <= numOfChoices){
            //----------
            // 表示対象
            //----------
            // 該当箇所から非表示クラスを削除
            $(className).removeClass(hide);

          } else {
            //----------
            // 非表示対象
            //----------
            // 該当箇所へ非表示クラスを設定
            $(className).addClass(hide);

          }
        }
        return false;
      });

      //
      //  グラフ有無　変更時処理
      //
      $('input[name="falg_graph_exists"]:radio').change(function(){
        var radioval = $(this).val();

        // 選択されたラジオ判定
        if(radioval == 0){
          //ファイル選択 無効化
          $('.image_item').addClass('hide_item');
        } else {
        //ファイル選択 有効化
        $('.image_item').removeClass('hide_item');
        }
      });

      //
      //  正答ボタン　変更時処理
      //
      $('input:checkbox').change(function(){
        // チェックされている正答ボタンの数を算出
        var numOfChecked  = 0;

        for(var index_seitou = 0; index_seitou < 9; index_seitou++){

          // 
          var index_seitou_plus1  = index_seitou + 1;

          //クエリセレクタ
          var id_seitou = '#answer' + index_seitou_plus1;

          // 正答ボタン　押下判定
          // チェックボックスがチェックされているかどうかの判定。方法が間違えているかも。
          if($(id_seitou).is(':checked')){
            numOfChecked++;
          }
        }

        // hidden項目の値として設定
        $('#hidden_numOfAns').val(numOfChecked);

        //console.log('正答ボタン押下判定。チェック数：' + numOfChecked);

      });

/*

      // 図・表無し選択時
      $('#label_flag_0').click(function(){

        //ファイル選択 無効化
        $('.image_item').addClass('hide_item');
      )}

      // 図・表有り選択時
      $('#label_flag_1').click(function(){

        //ファイル選択 有効化
        $('.image_item').removeClass('hide_item');
      )}
*/
    });

  </script>

@endsection