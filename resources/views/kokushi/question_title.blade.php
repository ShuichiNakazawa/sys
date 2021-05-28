<!-- resources/views/kokushi/question_title.blade.php -->
{{--
	データセット：
					'subjects'
					'titles'
					'subject_id'

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
    <h3>問題タイトルリスト</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <h4>問題タイトル</h4>
      科目名：
			<select id="subject_name">
	  		<option value="0"> </option>
				@foreach($subjects as $subject)
					@if ( $subject_id == $subject->id)
	    			<option value="{{ $subject->id }}" selected="selected">{{ $subject->subject_name }}</option>
					@else
						<option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
					@endif
				@endforeach
      </select>
      <br><br>

      <table class="table table-striped task-table">
				<thead>
					<th>問題タイトル一覧</th>
				</thead>

				<tbody>
					<tr>
						<th>タイトルID</th>
						<th>問題タイトル名</th>
						<th></th>
						<th></th>
					</tr>

					@foreach($titles as $title)
						<tr>
							<td class="table-text">
								<div>{{ $title->title_id }}</div>
							</td>

							<td class="table-text">
								<div>{{ $title->questions_title }}</div>
							</td>
							<td>
								<a href="{{ action('KokushiController@editTitle', [$title->subject_name_id, $title->id]) }}">
									<button>編集</button>
								</a>
							</td>
							<td>
								<form action="{{ action('KokushiController@destroyQuestionsTitle', $title->id) }}" method="post">
								@csrf
								@method('DELETE')
									<button>削除</button>
								</form>
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
    $(function(){
      $('#subject_name').change(function() {

        // 科目ID 取得
        var subject_id	=	$('#subject_name option:selected').val();
        window.location.href = subject_id;
      })
    });
  </script>
@endsection
