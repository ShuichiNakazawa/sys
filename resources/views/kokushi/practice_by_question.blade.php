<!-- resources/views/rooms/practice_by_question.blade.php -->
{{--
  datasources
  $question_sentence  問題文
--}}

@extends('layouts.app_kokushi')
{{--
@extends('layouts.app_no_cache')
--}}
@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

{{--
@php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0, post-check=0, pre-check=0");
	header("Pragma: no-cache");
@endphp
--}}



<div class="card-body width_adjustment_900">
  <div class="card-body">
    <h3 class="txt_center">一問一答</h3>
  </div>
	<div style="text-align: right;">
		試験中ユーザー：{{ $user_name }}
	</div>
	<br>
	<div style="display: flex;">
		
		<table align="right">
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
				@for($index = 0; $index < 5; $index++)
					<td>
						@if($judges[$index] == 1)
							〇
						@elseif($judges[$index] == 2)
							×
						@else
							{{ $judges[$index] }}
						@endif
					</td>
				@endfor
		</table>
	</div>

	<div class="card-body question_sentence_outer">
		<form action="{{ url('kokushi/' . $subject_id . '/practice_by_question/'  . $question_sentence->question_title_id . '/' . $question_sentence->question_number) }}">
			<p>{{ $question_sentence->subject_name }}&nbsp;&nbsp;{{ $question_sentence->question_title }}</p>

			<p>問{{ $question_sentence->question_number }}</p>
			<p>{{ $question_sentence->question_sentence }}</p>

			@foreach ($choice_sentences as $choice_sentence)
				@if ($number_of_need_select == 1)
					@switch($selected_answer)
						@case($choice_sentence->choice_id)
							<div class="choice_chara">
								{{--
								choice_id:{{$choice_sentence->choice_id}}
								--}}
								<input type="radio" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" value="{{ $choice_sentence->choice_id }}" checked="checked">
								<label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">
									{{ $choice_characters[$choice_sentence->choice_id] }}
								</label>
								<div class="choice_sentence">
									{{ $choice_sentence->choice_sentence }}
								</div>
							</div>
							@break
						@case(99)
							<div class="choice_chara"><input type="radio" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" value="{{ $choice_sentence->choice_id }}"><label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">{{ $choice_characters[$choice_sentence->choice_id] }}</label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
							@break
						@default
							<div class="choice_chara"><input type="radio" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer" value="{{ $choice_sentence->choice_id }}" disabled="disabled"><label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">{{ $choice_characters[$choice_sentence->choice_id] }}</label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
					@endswitch

				@else		{{-- 必須回答数が複数の場合 --}}

					@switch($flag_correct)
						@case(0)
							<div class="choice_chara"><input type="checkbox" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer_{{ $choice_sentence->choice_id }}" value="true"><label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">{{ $choice_characters[$choice_sentence->choice_id] }}</label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
							@break
						@default
							@if (in_array($choice_sentence->choice_id, $array_sa, true))	{{-- 選択肢が選ばれている判定 --}}
								<div class="choice_chara"><input type="checkbox" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer_{{ $choice_sentence->choice_id }}" value="true" checked="checked" disabled="disabled"><label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">{{ $choice_characters[$choice_sentence->choice_id] }}</label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
							@else		{{-- 選ばれていない選択肢 --}}
								<div class="choice_chara"><input type="checkbox" id="choice_{{ $choice_sentence->choice_id }}" name="selected_answer_{{ $choice_sentence->choice_id }}" value="true" disabled="disabled"><label for="choice_{{ $choice_sentence->choice_id }}" class="btn-choice">{{ $choice_characters[$choice_sentence->choice_id] }}</label><div class="choice_sentence">{{ $choice_sentence->choice_sentence }}</div></div>
							@endif
					@endswitch
				@endif
			@endforeach

			<div class="card-body">
				@if ($selected_answer == 99)
					<input type="submit" name ="judge" value="判定">&nbsp;&nbsp;&nbsp;&nbsp;
				@else
					<input type="submit" name ="judge" value="判定" disabled="disabled">&nbsp;&nbsp;&nbsp;&nbsp;
				@endif

				<input type="hidden" id="flag_correct" value="{{ $flag_correct }}">
				<input type="hidden" id="sound_type" value="{{ $soundType }}">
				@switch($flag_correct)
					@case(0)
						@break

					@case(1)
						正解
						@break

					@default
						不正解&nbsp;&nbsp;&nbsp;&nbsp;正解は

						@if (is_string($array_ca))
							{{ $choice_characters[((int)$array_ca - 1)] }}
						@else
							@foreach ($array_ca as $ans)
								@if (!($loop->first))
								,
								@endif
								{{ $choice_characters[((int)$ans - 1)] }}
							@endforeach
						@endif
				@endswitch
				<br><br>

				@if ($question_sentence->question_number != 1)
					<input type="submit" name="another_question" value="前の問題へ">&nbsp;&nbsp;&nbsp;
				@endif

				@if ($question_sentence->question_number == $question_last_number)
					<input type="submit" name="another_question" value="結果判定">
				@else
					<input type="submit" name="another_question" value="次の問題へ">
				@endif
			</div>
		</form>
	</div>
</div>
<br>

<audio src="{{ asset('/audio/itako_seikai.wav')}}" id="audio2"></audio>
<audio src="{{ asset('/audio/correct.mp3')}}" id="audio3"></audio>

  <div class="listArea">
    <div class="innerList">

      <!-- TOP  -->


    </div>
  </div>
@endsection

@section('script')
	<script src="{{ asset('js/play_audio.js') }}"type="module">

	</script>
@endsection