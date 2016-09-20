@extends('layouts.master')
  
@section('content')

<table class='table'>
	<tbody>
		<tr>
			<td>등록폼</td>
			<td><a href="{{ route('task.add') }}" target="_blank">바로가기</a></td>
		</tr>
	</tbody>
</table>
@endsection