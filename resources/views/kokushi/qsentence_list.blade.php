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
      <form action="{{ url('management/qsentence_list') }}">
      	@csrf
        科目名：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<select id="subject_name" name="subject_name">
					<option value="0"> </option>
					@foreach($subjects as $subject)
						@if ( $subject_name == $subject->subject_name)
							<option value="{{ $subject->subject_name }}" selected="selected">{{ $subject->subject_name }}</option>
							@php
								$subject_name_id = $subject->id
							@endphp
						@else
              <option value="{{ $subject->subject_name }}" name="{{ $subject_id }}">{{ $subject->subject_name }}</option>
	    			@endif
	  			@endforeach
        </select>

				<input type="hidden" name="subject_id" value="{{ $subject_id }}">
				<input type="submit" value="選択">
        <br><br>

        問題タイトル：
        <select id="questions_title" name="questions_title">
					<option value="0"> </option>
          @foreach($titles as $title)
						@if ($questions_title == $title->questions_title)
							<option value="{{ $title->questions_title }}" selected="selected">{{ $title->questions_title }}</option>
						@else
							<option value="{{ $title->questions_title }}">{{ $title->questions_title }}</option>
						@endif
					@endforeach
				</select>

				<input type="submit" value="選択">
			</form>

      <table class="table table-striped task-table">
				<thead>
					<th>問題文一覧</th>
				</thead>

				<tbody>
					<tr>
						<th>問題番号</th>
						<th>問題文</th>
						<th></th>
						<th></th>
					</tr>

					@foreach($qsentences as $qsentence)

						<tr>
							<td class="table-text">
								<div>{{ $qsentence->question_number }}</div>
							</td>

							<td class="table-text">
								<div>{{ $qsentence->question_sentence }}</div>
							</td>
							<td>
								<button>編集</button>
							</td>
							<td>
								<button>削除</button>
							</td>
						</tr>
					@endforeach
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
