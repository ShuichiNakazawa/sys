<!-- resources/views/kokushi/qsentence_list.blade.php -->
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
    <h3>問題文リスト</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
{{--
      <h4>問題タイトル</h4>
--}}

      <form action="{{ url('/kokushi/management/qsentence_list') }}">
      	@csrf
        科目名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select id="subject_name" name="subject_id">
					<option value="0"> </option>
					@foreach($subjects as $subject)
						{{--
						@if ( $subject_name == $subject->subject_name)
						--}}
						@if ( $subject_id == $subject->id)
							<option value="{{ $subject->id }}" selected="selected">{{ $subject->subject_name }}</option>
							@php
								$subject_name_id = $subject->id
							@endphp
						@else
              <option value="{{ $subject->id }}" name="{{ $subject_id }}">{{ $subject->subject_name }}</option>
	    			@endif
	  			@endforeach
        </select>

				{{--
				<input type="hidden" name="subject_id" value="{{ $subject_id }}">
				--}}
				<input type="submit" value="選択">
        <br><br>

        問題タイトル：
        <select id="question_title" name="title_id">
					<option value="0"> </option>
          @foreach($titles as $title)
						@if ($title_id == $title->title_id)
							<option value="{{ $title->title_id }}" selected="selected">{{ $title->question_title }}</option>
						@else
							<option value="{{ $title->title_id }}">{{ $title->question_title }}</option>
						@endif
					@endforeach
				</select>

				<input type="submit" value="選択">
			</form>
{{--
			@php
				dd($subject_id, $question_title);		
			@endphp
--}}

      <table class="table table-striped task-table">
				<thead>
					<th>問題文一覧</th>
				</thead>

				<tbody>
					<tr>
						<th>問題番号</th>
						<th>問題文</th>
						<th>必須回答数</th>
						<th>選択肢数</th>
						<th>正答数</th>
						<th colspan="2">操作</th>
					</tr>

					@if(null !== $qsentences)
						@foreach($qsentences as $qsentence)

							<tr>
								<td class="table-text">
									<div>{{ $qsentence->question_number }}</div>
								</td>

								<td class="table-text">
									
									<div>{{ mb_substr($qsentence->question_sentence, 0, 70) }}</div>
									
									{{--
									<div>{{ $qsentence->question_sentence }}</div>
									--}}
								</td>
								<td>
									<div>{{ $qsentence->required_numOfAnswers }}</div>
								</td>
								<td>
									<div>{{ $qsentence->number_of_choices }}</div>
								</td>
								<td>
									<div>{{ $qsentence->number_of_answers }}</div>
								</td>

								<td>
									<a href="{{ url('/kokushi/management/edit_q_sentence/'
																	 . $subject_id . '/'
																	 . $title_id . '/'
																	 . $qsentence->question_number) }}">
										<button>編集</button>
									</a>
								</td>
								<td>
									<form action="{{ route('kokushi.management.destroyQuestionSentence') }}" method="post">
										@csrf
										@method('delete')

										<input type="hidden" name="subject_id" value="{{ $subject_id }}">
										<input type="hidden" name="title_id" value="{{ $title_id }}">
										<input type="hidden" name="question_number" value="{{ $qsentence->question_number }}">


										<button type="submit">削除</button>
									</form>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
<br>

<div class="listArea">
	<div class="innerList">
		<!-- TOP  -->
	</div>
</div>
@endsection

@section('script')
  <script type="module">
{{--
    $(function(){
      $('#subject_name').change(function() {

        // 科目ID 取得
        var subject_id	=	$('#subject_name option:selected').val();

	//ここでポストしたい
        window.location.href = "";
      })
    });
--}}
  </script>
@endsection
