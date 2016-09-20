<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Task;
use App\Project;
use App\User;
use App\Role;
use App\Picture;
class OrmController extends Controller
{
	public function getAll()  
	{
		$tasks = Task::all();
		/*foreach ($tasks as $task)
		{
			echo "Id: " . $task->id . " name :" . $task->name.'<br>';
		}*/
		return $tasks;
	}
	public function getFind($id)
	{
		$task = Task::find($id);
	 
		return response()->json($task, 200, [], JSON_PRETTY_PRINT);
	}

	public function getWhere()
	{
		$tasks = Task::where('id', '>', 1)
					->where('id', '<', 20)
					->where('name', 'like', 'Q%')
					->orderBy('name', 'desc')
					->skip(0)
					->take(3)
					->get();
		//->first();
		return  response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
	}

	public function getWhereIn()
	{
		$idArr = Array(3, 5, 6);
		$tasks = Task::whereIn('id', $idArr)->get();
	  
		return response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
	}

	public function getWhereNotIn()
	{
	   $tasks = Task::whereNotIn ('id', [3, 5, 6])->get();
	  
	   return response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
	}

	public function getWhereBetween()
	{
	   $tasks = Task::whereBetween('id', [5, 9])->get();
	  
	   return response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
	}
	public function getWhereNull()
	{
	   $tasks = Task::whereNull('description')->get();
	   //$tasks = Task::where('description', '')->get();
	 
	   return response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
	}

	public function getWhereParam()
	{
		$tasks = Task::where('id', '=', 10)
				->OrWhere(function ($query) {
					$query->where('name', 'like', 'Q%')
					  ->where('id', '>', 3)
					  ->where('id', '<', 8);
				})
				->get();
	 
		return response()->json($tasks, 200, [], JSON_PRETTY_PRINT);
	}
	public function getInsert()
	{
		$task = new Task;
	 
		$task->name = '예제 작성';
		$task->project_id = 13;
		$task->description = 'insert 예제 작성';
	 
		$ret = $task->save();
	 
		return response()->json(['result' => $ret, 'task' => $task],
				 200, [], JSON_PRETTY_PRINT);
	}
	public function getUpdate($id){
		//insert 와 차이점 find 불러옴
		$task = Task::find($id);
		//데이터 갱신
		$task->name = '엡데이트 - 예제 작성';
		$task->project_id = 18;
		$task->description = '업테이트 - insert 예제 작성';
		$res = $task->save();
		return response()->json(['result' => $res, 'task' => $task],
				200, [], JSON_PRETTY_PRINT);
	}
	public function getUpdate2($id)
	{
		$param = [
			'name' => '엡데이트2 - 예제 작성',
			'project_id' => 14,
			'description' => '엡데이트2 - insert 예제 작성'
		   ];
		$task = Task::find($id)->update($param);
		return response()->json(['result' => $ret, 'task' => $task],
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getInsertMass()
	{
		$param = [
			'name' => '예제 작성',
			'project_id' => 15,
			'description' => 'insert mass 예제 작성',
		   ];
	 
		$task = Task::create($param);
	 
		return response()->json($task,
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getDestroy($id)
	{
		$ret = Task::destroy($id);
		 
		return response()->json(['ret' => $ret],
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getDestroyArray($id)
	{  
		// 1,2,3 형식의 $id 를 배열로 변환
		$array = explode(',', $id);
	 
		$ret = Task::destroy($array);
		 
		return response()->json(['ret' => $ret],
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getDeleteWhere($from, $to)
	{  
		$ret = Task::where('id', '>', $from)
			->where('id', '<', $to)->delete();
		 
		return response()->json(['ret' => $ret],
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getSoftDeletedList()
	{  
		$tasks = Task::onlyTrashed()
			->where('id', '>', 10)
			->get();
		 
		return response()->json($tasks,
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getRestoreSoftDelete($id)
	{  
		$ret = Task::withTrashed()
			->find($id)
			->restore();
		 
		return response()->json(['ret' => $ret],
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getForceDelete($id)
	{  
	   Task::withTrashed()
			->find($id)
			->forceDelete();
		 
		return response()->json(['ret' => $id],
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getDueIn7Days()
	{
		$tasks = \App\Task::dueIn7Days()
					->take(5)
					->orderBy('due_date', 'desc')               
					->get();
	 
		 return response()->json($tasks,
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getDueInDays($day)
	{
		$tasks = \App\Task::dueInDays($day)
					->take(5)
					->orderBy('due_date', 'desc')               
					->get();
	 
		 return response()->json($tasks,
			 200, [], JSON_PRETTY_PRINT);
	}
	public function getUserInsert()
	{
		$user = \App\User::create([
			'name'=>'Test2',
			'password' => 'a1234567',
			'account' => '12345678902',
			'email' => 'abcdefg@gmail.com',
			]);
	 
		return response()->json($user,
			 200, [], JSON_PRETTY_PRINT);
	}
	/***
		mutator,accessor 테스트
	***/
	public function getMutatorTest(){
		// 입력시 mutator 자동 호출
		$u1 = \App\User::create([
			'name' => 'Test7',
			'password' => 'a1234567',
			'account' => '1234567890221',
			'email' => 'text7@host.com'
		]);
		dump($u1);

		$u2 = \App\User::find($u1->id);
		//accessor 호출
		dump($u2->account);
	}

	public function getOneToMany($id)
	{
		$tasks = Project::findOrFail($id)->tasks()->orderBy('name')->get();
		dd($tasks);    
	}

	public function getManyToMany($id)
	{
		$users = Role::findOrFail($id)->users()->orderBy('name')->get();
		dd($users);    
	}

	public function getHasManyThrough($id)
	{
		$tasks = User::findOrFail($id)->tasks()->orderBy('created_at')->get();
		dd($tasks);      
	}

	public function getMorphTo($id)
	{
		$pic = Picture::find($id);
		$imageable = $pic->imageable;
		dump($imageable);
	}
}
