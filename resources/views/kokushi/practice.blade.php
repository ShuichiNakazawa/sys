<!-- resources/views/rooms/practice.blade.php -->
{{--
  datasources
  $question_sentence  問題文

--}}
@extends('layouts.app')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body">
  <div class="card-body">
    <h3>模擬試験</h3>
  </div>
  <div class="card-body question_sentence_outer">
    <form action="{{ url('/' . $subject_short_name . '/practice/' . $question_sentence->subject_id . '/' . $question_sentence->questions_title_id . '/' . $question_sentence->question_number) }}">
      <p>{{ $question_sentence->subject_name }}&nbsp;&nbsp;{{ $question_sentence->questions_title }}</p>

        <p>問{{ $question_sentence->question_number }}</p>
        <p>{{ $question_sentence->question_sentence }}</p>

        @foreach ($choice_sentences as $choice_sentence)
	  @if ($number_of_answers == 1)
	    <div class="choice_chara"><label for="choice_{{ $choice_sentence->choice_id }}"><input type="radio" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" value="{{ $choice_sentence->choice_id }}"><span class="btn-choice" role="button">{{ $choice_characters[$choice_sentence->choice_id] }}</span></label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
	  @else
	  <div class="choice_chara"><label for="choice_{{ $choice_sentence->choice_id }}"><input type="checkbox" id="choice_{{ $choice_sentence->choice_id }}"name="selected_answer" value="{{ $choice_sentence->choice_id }}"><span class="btn-choice" role="button">{{ $choice_characters[$choice_sentence->choice_id] }}</span></label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
	  @endif
        @endforeach

      <div class="card-body">
	@if ($question_sentence->question_number != 1)
	  <input type="submit" name="another_question" value="前の問題へ">&nbsp;&nbsp;&nbsp;
	@endif
	@if ($question_sentence->question_number == $question_last_number)
	  <input type="submit" value="結果判定">
	@else
          <input type="submit" name="another_question" value="次の問題へ">
	@endif
      </div>
    </form>
  </div>

</div>
<br>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection
