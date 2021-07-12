<!-- resources/views/rooms/store_q_sentence.blade.php -->
@extends('layouts.app')

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

    <form action="{{ url('/kokushi/management/store_q_sentence') }}">
      @csrf

      科目グループ名：

      <select id="subject_group_id" name="subject_group_id">
        <option value="0"> </option>
        @foreach($subject_groups as $subject_group)
          @if ( $subject_group_name == $subject_group->subject_group_name)
            <option value="{{ $subject_group->id }}" selected="selected">{{ $subject_group->subject_group_name }}</option>
            @php
              $subject_group_id = $subject_group->id
            @endphp
          @else
            <option value="{{ $subject_group->id }}" name="{{ $subject_group_id }}">{{ $subject_group->subject_group_name }}</option>
          @endif
        @endforeach
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      科目名：
      <select id="subject_id" name="subject_id">
        <option value="0"> </option>
        @foreach($subjects as $subject)
          @if ( $subject_id == $subject->id)
            <option value="{{ $subject->id }}" selected="selected">{{ $subject->subject_name }}</option>
            {{--
            @php
              $subject_id = $subject->id
            @endphp
            --}}
          @else
            <option value="{{ $subject->id }}" name="{{ $subject_id }}">{{ $subject->subject_name }}</option>
          @endif
        @endforeach
      </select>

      {{--
      <input type="hidden" name="subject_id" value="{{ $subject_id }}">
      --}}
      <input type="submit" value="選択">
    </form>
    <br>

    <form enctype="multipart/form-data" action="{{ url('/kokushi/management/store_q_sentence') }}" method="POST">
      @csrf

      問題タイトル：　
      <select id="question_title_id" name="question_title_id">
        <option value="0"> </option>
        @foreach($titles as $title)
          @if ($question_title == $title->question_title)
            <option value="{{ $title->title_id }}" selected="selected">{{ $title->question_title }}</option>
          @else
            <option value="{{ $title->title_id }}">{{ $title->question_title }}</option>
          @endif
          {{--
          <input type="hidden" name="title_name" value="{{ $title->question_title }}">
          --}}
        @endforeach
      </select>
      <br><br>

      問題番号：
      <input type="text" name="question_number" value="{{ $question_number }}" size="3">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      選択肢の数：
      <select name="number_of_choices" id="number_of_choices">
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
      </select>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      必須回答数：
      <select name="required_numOfAnswers">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <br><br>

      <table class="table table-striped task-table">
        <tbody>
          <tr>
            <td style="vertical-align: middle; width:90px;">
              問題文
            </td>
            <td colspan="2">
              <textarea style="valign: middle;" name="question_sentence" value="" cols="80" rows="2"></textarea>
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

          <tr>
            <td class="choiceItem_col1">
              選択肢１
            </td>
            <td class="choiceItem_col2">
              <textarea name="choice1" cols="80" rows="2"></textarea>
            </td>
            <td class="choiceItem_col3">
              <input type="checkbox" name="answer1" id="answer1">
              <label for="answer1" class="btn-correct_answer">正答</label>
            </td>
          </tr>

          <tr>
            <td class="choiceItem_col1">
              選択肢２
            </td>
            <td class="choiceItem_col2">
              <textarea name="choice2" cols="80" rows="2"></textarea>
            </td>
            <td class="choiceItem_col3">
              <input type="checkbox" name="answer2" id="answer2">
              <label for="answer2" class="btn-correct_answer">正答</label>
            </td>
          </tr>

          <tr>
            <td class="choiceItem_col1">
              選択肢３
            </td>
            <td class="choiceItem_col2">
              <textarea name="choice3" cols="80" rows="2"></textarea>
            </td>
            <td class="choiceItem_col3">
              <input type="checkbox" name="answer3" id="answer3">
              <label for="answer3" class="btn-correct_answer">正答</label>
            </td>
          </tr>

          <tr>
            <td class="choiceItem_col1">
              選択肢４
            </td>
            <td class="choiceItem_col2">
              <textarea name="choice4" cols="80" rows="2"></textarea>
            </td>
            <td class="choiceItem_col3">
              <input type="checkbox" name="answer4" id="answer4">
              <label for="answer4" class="btn-correct_answer">正答</label>
            </td>
          </tr>

          <tr class="choice5 choice_hide">
            <td class="choice5 choice_hide choiceItem_col1">
              選択肢５
            </td>
            <td class="choice5 choice_hide choiceItem_col2">
              <textarea class="choice5 choice_hide" name="choice5" cols="80" rows="2"></textarea>
            </td>
            <td class="choice5 choice_hide choiceItem_col3">
              <input type="checkbox" name="answer5" id="answer5" class="choice5 choice_hide">
              <label for="answer5" class="btn-correct_answer choice5 choice_hide">正答</label>
            </td>
          </tr>

          <tr class="choice6 choice_hide">
            <td class="choice6 choice_hide choiceItem_col1">
              選択肢６
            </td>
            <td class="choice6 choice_hide choiceItem_col2">
              <textarea class="choice6 choice_hide" name="choice6" cols="80" rows="2"></textarea>
            </td>
            <td class="choice6 choice_hide choiceItem_col3">
              <input type="checkbox" name="answer6" id="answer6" class="choice6 choice_hide">
              <label for="answer6" class="btn-correct_answer choice6 choice_hide">正答</label>
            </td>
          </tr>

          <tr class="choice7 choice_hide">
            <td class="choice7 choice_hide choiceItem_col1">
              選択肢７
            </td>
            <td class="choice7 choice_hide choiceItem_col2">
              <textarea class="choice7 choice_hide" name="choice7" cols="80" rows="2"></textarea>
            </td>
            <td class="choice7 choice_hide choiceItem_col3">
              <input type="checkbox" name="answer7" id="answer7" class="choice7 choice_hide">
              <label for="answer7" class="btn-correct_answer choice7 choice_hide">正答</label>
            </td>
          </tr>

          <tr class="choice8 choice_hide">
            <td  class="choice8 choice_hide  choiceItem_col1">
              選択肢８
            </td>
            <td class="choice8 choice_hide choiceItem_col2">
              <textarea class="choice8 choice_hide" name="choice8" cols="80" rows="2"></textarea>
            </td>
            <td class="choice8 choice_hide choiceItem_col3">
              <input type="checkbox" name="answer8" id="answer8" class="choice8 choice_hide">
              <label for="answer8" class="btn-correct_answer choice8 choice_hide">正答</label>
            </td>
          </tr>

          <tr class="choice9 choice_hide">
            <td class="choice9 choice_hide choiceItem_col1">
              選択肢９
            </td>
            <td class="choice9 choice_hide  choiceItem_col2">
              <textarea class="choice9 choice_hide" name="choice9" cols="80" rows="2"></textarea>
            </td>
            <td class="choice9 choice_hide  choiceItem_col3">
              <input type="checkbox" name="answer9" id="answer9" class="choice9 choice_hide">
              <label for="answer9" class="btn-correct_answer choice9 choice_hide">正答</label>
            </td>
          </tr>

        </tbody>
      </table>

      <input type="hidden" name="subject_name_id" value="{{ $subject_id }}">
      <input type="submit" value="登録">

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
      })


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
      })
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