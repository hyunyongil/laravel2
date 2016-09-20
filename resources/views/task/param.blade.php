@extends('layouts.master')
  
@section('content')

<table class='table'>
	<thead>
		<tr>
			<th>아이디</th>
			<th>평균치</th>
		</tr>
	</thead>
	<tbody>
	@foreach($tasks as $task)
		<tr>
			<td>{{ $task['id'] }}</td>
			<td>{{ $task['arg'] }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection