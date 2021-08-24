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
    <h3>科目名リスト</h3>
  </div>
  <div class="card-body">
    <div class="card-body store_question_sentence_outer">
      <table class="table table-striped task-table">
				<tbody>
	  			<tr>
						<th>科目ID</th>
						<th>科目名</th>
						<th></th>
						<th></th>
					</tr>

					@foreach($subjects as $subject)

						<tr>
							<td class="table-text">
								<div>
									<input type="text" name="subject_id" value="{{ $subject->id }}" size = "3">
								</div>
							</td>

							<td class="table-text">
								<div>
									<input type="text" name="subject_name" value="{{ $subject->subject_name }}" size = "{{ $subject_name_size }}">
								</div>
							</td>
							<td>
								<a href="{{ action('IpqManagementController@editSubject', $subject->id) }}">
									<button>編集</button>
								</a>
							</td>

							<td>
								<form action="{{ action('IpqManagementController@destroySubject', $subject->id) }}" method="post">
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
