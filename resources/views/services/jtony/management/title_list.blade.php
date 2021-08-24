<!-- resources/views/rooms/subject_list.blade.php -->
@extends('layouts.app_ipquestion')

@section('content')

@if(session('message'))
<div class="alert alert-success">
  {{ session('message') }}
</div>
@endif

@include('common.errors')

<div class="card-body">
  <div class="card-body">
    <h3>タイトルリスト</h3>
  </div>
  <div class="card-body">
	<div>
		科目名：
		<select id = "subject_id" name = "subject_id">
			<option value = "0"></option>
			@foreach($subjects as $subject)
				@if($subject_id == $subject->id)
					<option value = "{{ $subject->id }}" selected>{{ $subject->subject_name }}</option>
				@else
					<option value = "{{ $subject->id }}">{{ $subject->subject_name }}</option>
				@endif
			@endforeach
			
		</select>
		<input type = "submit" id="select_subject_id" value="選択">
	  </div>

    <div class="card-body store_question_sentence_outer">

      <table class="table table-striped task-table">
				<thead>
	  			<th>タイトル一覧</th>
				</thead>

				<tbody>
	  			<tr>
						<th>タイトルID</th>
						<th>タイトル名</th>
						<th></th>
						<th></th>
					</tr>

					@foreach($titles as $title)

						<form action="{{ action('IpqManagementController@editTitle', $subject_id) }}" method="post">
						@csrf

						<tr>
							<td class="table-text">
								<div>
									<input type="text" name="title_id" value="{{ $title->title_id }}" size = "2">
									<input type="hidden" name="title_id_old" value="{{ $title->title_id }}">
								</div>
							</td>

							<td class="table-text">
								<div>
									<input type="text" name="title_name" value="{{ $title->question_title }}">
									
								</div>
							</td>
							<td>
								<input type="hidden" name="subjectId" value="{{ $subject_id }}">
								<input type="submit" value="編集">
								{{--
								<a href="{{ action('IpqManagementController@editTitle', $subject_id, $title->id) }}">
									
									<button>編集</button>
									
								</a>
								--}}
							</td>
						</form>

							<td>
								<form action="{{ action('IpqManagementController@destroyTitle', $subject_id, $title->id) }}" method="post">
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

@endsection