@extends('layouts.master')
  
@section('content')
<!--@foreach ($tasks as $task)
    <p> 할 일: {{ $task['name'] }}, 기 한: {{ $task['due_date'] }} </p>
@endforeach

@for ($i = 0; $i < count($tasks); $i++)
    <p> 할 일: {{ $tasks[$i]['name'] }}, 기 한: {{ $tasks[$i]['due_date'] }} </p>
@endfor-->

<table class='table'>
	<thead>
		<tr>
			<th>할 일</th>
			<th>기 한</th>
		</tr>
	</thead>
	<tbody>
	@foreach($tasks as $task)
		<tr>
			<td>{{ $task['name'] }}</td>
			<td>{{ $task['due_date'] }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection