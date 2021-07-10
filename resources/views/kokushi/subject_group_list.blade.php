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
    <h3>科目グループリスト</h3>
  </div>
  <div class="card-body">
    <div class="card-body">
      <table class="table table-striped task-table">
				<thead>
	  			<th>科目グループ一覧</th>
				</thead>

				<tbody>
	  			<tr>
						<th>科目グループID</th>
						<th>科目グループ名</th>
						<th></th>
						<th></th>
					</tr>

					@foreach($subject_groups as $subject_group)

						<tr>
							<td class="table-text">
								<div>{{ $subject_group->id }}</div>
							</td>

							<td class="table-text">
								<div>{{ $subject_group->subject_group_name }}</div>
							</td>
							<td>
								<a href="{{ action('KokushiManagementController@editSubjectGroup', $subject_group->id) }}">
									<button>編集</button>
								</a>
							</td>

							<td>
								<form action="{{ action('KokushiManagementController@destroySubjectGroup', $subject_group->id) }}" method="post">
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
