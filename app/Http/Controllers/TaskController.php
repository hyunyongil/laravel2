<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TaskController extends Controller
{
    public function list2(){
		$tasks= [
			['name' => 'Response 클래스 분석', 'due_date' => '2015-06-01 11:22:33'],
			['name' => '블레이드 예제 작성', 'due_date' => '2015-06-03 15:21:13'],
		]; 
		return view('task.list2')->with('tasks', $tasks);		
	}
	public function param(Request $request, $id = 1, $arg = 'argument'){
       dump( ['path' => $request->path(),
              'url' => $request->url(),
              'fullUrl' => $request->fullUrl(),
              'method' => $request->method(),
              'name' => $request->get('name'),
              'ajax' => $request->ajax(),
              'header' => $request->header(),
        ]);    
		$tasks = [['id' => $id, 'arg' => $arg]];
		return view('task.param')->with('tasks', $tasks);
	}
	public function add(){
		return view('task.add');
	}
}
