@extends('layouts.app_ipquestion')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<br><br><br>
<div class="width_adjust" style="margin: 0 auto;">
  <br><br>
    <div class="container">     
      <div class = "title_outer" style="display: block;">
        <img src = "{{ asset('icon/computer_work.png') }}" alt="computer"><span style="font-size:32px;font-weight:bold;color:#30b279;">問題に挑戦</span>
      </div>
      <div style="display: block; width: 100%;">
      </div>

      <div class="questions_outer">
        <div class="row">
          <div style="margin-left: 36px; font-size: 20px;">
            {{-- 科目  タイトル --}}
            {{ $subject_name }}
            <br>
            <span style="font-size: 16px;">
              {{ $question_title }}
            </span>
          </div>

          <div style="width: 200px;">
          </div>


          {{-- 正誤履歴 --}}
          <div style="display: flex; align-items: center; justify-content: flex-end;">
            <div style="width: 50px;">
            </div>
  
            <div>
              <table>
                <tr>
                  <th class="" style="width: 70px;">
                    前回
                  </th>
                  <th style="width: 70px;">
                    前々回
                  </th>
                  <th style="width: 70px;">
                    ３回前
                  </th>
                  <th style="width: 70px;">
                    ４回前
                  </th>
                  <th style="width: 70px;">
                    ５回前
                  </th>
                </tr>
                <tr>
                  {{-- Eloquent で取得する予定なので、@foreach に変更するかもしれない --}}
                  @for($index = 0; $index < 5; $index++)
                    <td>
                      @if($judges[$index] == 1)
                        〇
                      @elseif($judges[$index] == 0)
                        ×
                      @else
                        {{ $judges[$index] }}
                      @endif
                    </td>
                  @endfor
              </table>
            </div>
          </div>



        </div>

        <div style="width: 100%">
        </div>
        <br>
        <form action="{{ action('IpquestionController@screenTransition' , [$subject_id, $title_id, $question_number]) }}" method="post">
          @csrf

          {{-- 問題番号 --}}
          <p>問{{ $question_sentence->question_number }}</p>
          <input type="hidden" name="question_number" value="{{ $question_sentence->question_number }}">
          <div style="width: 100%">
          </div>

            {{-- 問題文 --}}
            <p>{{ $question_sentence->question_sentence }}</p>
            <br><br>

            {{-- 図・表 --}}
            @if($question_sentence->flag_graph_exists == 1)
              <div style="width: 100%">
              </div>

              図が入る
              <br>
              {{ $question_sentence->image_filename }}

            @endif
            <div style="width: 100%">
            </div>

            <br>          

            {{-- 必須回答数によって、選択肢のタイプをボタン・チェックボックスに変更する --}}

            @if($question_sentence->required_numOfAnswers == 0)
              ※正答なし
              <br>
              <input type="hidden" name="no_answer" value="1">
            @endif

            <input type="hidden" name="required_numOfAnswers" value="{{ $question_sentence->required_numOfAnswers }}">
            <input type="hidden" name="number_of_answers" value="{{ $question_sentence->number_of_answers }}">

            {{-- 選択肢文 --}}
            @foreach($choice_sentences as $choice_sentence)
              <div class="choice_centence_area" style="display: flex; align-items: center;">
                {{-- 上下中央に配置されるスタイルを適用 --}}
                <div style="align-items: center; width: 45px;">
                  @if( $question_sentence->required_numOfAnswers == 1 || $question_sentence->required_numOfAnswers == 0 )

                    @php
                      $flag_selected  = 0;
                    @endphp

                    {{-- 選択状態　判定 --}}
                    @foreach($selected_answers as $selected_answer)
                      
                      @if($selected_answer->choice_id == $choice_sentence->choice_id)
                        @php
                          $flag_selected = 1;
                        @endphp
                      @endif
                    @endforeach

                    @if( $flag_selected == 1)
                      <input type="radio" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" style="display: none;" value="{{ $choice_sentence->choice_id }}" checked>
                    @else
                      <input type="radio" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" style="display: none;" value="{{ $choice_sentence->choice_id }}">
                    @endif
                  @elseif($question_sentence->required_numOfAnswers > 1)

                    {{-- 選択状態　判定 --}}
                    @php
                      $flag_selected  = 0;
                    @endphp

                    {{-- 選択状態　判定 --}}
                    @foreach($selected_answers as $selected_answer)
                      
                      @if($selected_answer->choice_id == $choice_sentence->choice_id)
                        @php
                          $flag_selected = 1;
                        @endphp
                      @endif
                    @endforeach

                    @if( $flag_selected == 1)
                      <input type="checkbox" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" value="{{ $choice_sentence->choice_id }}" checked>
                    @else
                      <input type="checkbox" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" value="{{ $choice_sentence->choice_id }}">
                    @endif
                  @endif
                    <label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">
                      {{ $array_choices[$choice_sentence->choice_id] }}
                    </label>

                </div>
                <div style="margin-left: 10px;">
                  {{ $choice_sentence->choice_sentence }}  
                </div>
              </div>
              <div style="width: 100%">
              </div>
              <br><br>

            @endforeach

            <div>
              @if($question_number != 1)
                <button name="pressed_button" value="-1">
                  前の問題へ
                </button>
              @else
                
              @endif
    
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
              @if($question_number != $last_question_number)
                <button name="pressed_button" value="1">
                  次の問題へ
                </button>
              @else
                <button name="pressed_button" value="9">
                  テスト終了
                </button>
              @endif
            </div>

          </form>
          {{--
          @php
              dd($selected_answer);
          @endphp
          --}}

        </div>
        <br>

      </div>

      </div>
      <br>
  </div>

</div>
@endsection('content')

