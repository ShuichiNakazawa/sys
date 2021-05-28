<!-- resources/views/rooms/subject_list.blade.php -->
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
    <h3>科目名リスト</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <h4>科目</h4>
      <table class="table table-striped task-table">
				<thead>
	  			<th>科目一覧</th>
				</thead>

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
								<div>{{ $subject->id }}</div>
							</td>

							<td class="table-text">
								<div>{{ $subject->subject_name }}</div>
							</td>
							<td>
								<a href="{{ action('KokushiController@editSubject', $subject->id) }}">
									<button>編集</button>
								</a>
							</td>

							<td>
								<form action="{{ action('KokushiController@destroySubject', $subject->id) }}" method="post">
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
