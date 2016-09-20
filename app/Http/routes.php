<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return 'Hello World';
    //return view('welcome');
});

Route::get('hello/world', function() {
    return 'Hello World';
});

Route::get('hello/json', function(){
	$data = ['name' => 'yongil', 'gender' => 'Man'];
	return response()->json($data);
});

Route::get('hello/html', function(){
	return view('hello.html');	
});

Route::get('task/view', function(){
	$task = [ 'name'=>'애플 워치', 'due_date'=> date('Y-m-d H:i:s') ];
	$price = [ 'priceVal'=>'30,0000원'];
	return view('task.view', compact('task'))->with('price', $price);
});

Route::get('task/alert', function() {
    $task= ['name' => '라라벨 예제 작성', 
            'due_date' => '2015-06-01 11:22:33', 
            'comment' => '<script>alert("Welcome");</script>'];
   
    return view('task.alert')->with('task', $task);
});

Route::get('calc/{num}', function($num) {
    return view('calc')->with('num', $num);
});

Route::get('task/list2', 'TaskController@list2');

Route::get('task/param/{id}/{arg}', 'TaskController@param');

Route::get('task/add', ['as'=> 'task.add', 'uses'=> 'TaskController@add']);

Route::get('impl/collection', 'ImplicitController@getCollection');

Route::get('orm/all', 'OrmController@getAll');

Route::get('orm/find/{id}', 'OrmController@getFind');

Route::get('orm/where', 'OrmController@getWhere');

Route::get('orm/wherein', 'OrmController@getWhereIn');

Route::get('orm/wherenotin', 'OrmController@getWhereNotIn');

Route::get('orm/wherebetween', 'OrmController@getWhereBetween');

Route::get('orm/wherenull', 'OrmController@getWhereNull');

Route::get('orm/whereparam', 'OrmController@getWhereParam');

Route::get('orm/insert', 'OrmController@getInsert');

Route::get('orm/update/{id}', 'OrmController@getUpdate');

Route::get('orm/update2/{id}', 'OrmController@getUpdate2');

Route::get('orm/insertmass', 'OrmController@getInsertMass');

Route::get('orm/destroyarray/{id}', 'OrmController@getDestroyArray');

Route::get('orm/deletewhere/{from}/{to}', 'OrmController@getDeleteWhere');

Route::get('orm/softdelete', 'OrmController@getSoftDeletedList');

Route::get('orm/restoredelete/{id}', 'OrmController@getRestoreSoftDelete');

Route::get('orm/forcedelete/{id}', 'OrmController@getForceDelete');

Route::get('orm/duein7', 'OrmController@getDueIn7Days');

Route::get('orm/dueindays/{days}', 'OrmController@getDueInDays');

Route::get('orm/insertuser', 'OrmController@getUserInsert');

Route::get('orm/insertusertest', 'OrmController@getMutatorTest');

Route::get('orm/getonmany/{id}', 'OrmController@getOneToMany');

Route::get('orm/getmanytomany/{id}', 'OrmController@getManyToMany');

Route::get('orm/gethasmanythrough/{id}', 'OrmController@getHasManyThrough');

Route::get('orm/getmorphto/{id}', 'OrmController@getMorphTo');

/*Route::get('auth', function () {
    $credentials = [
        'email'    => 'yongil@onsolutions.co.kr',
        'password' => '123'
    ];

    if (! Auth::attempt($credentials)) {
        return '아이디 혹은 비밀번호가 정확하지 않습니다.';
    }

    return redirect('auth/protected');
});*/
/*
Route::get('auth/logout', function () {
    Auth::logout();

    return '다음에 또 봐요~';
});
*/
/*
Route::get('protected', function () {
    if (! Auth::check()) {
        return '로그인 상태가 아닙니다 로그인 해주세요~';
    }

    return '다시오신것을 환영합니다, ' . Auth::user()->name;
});*/

Route::get('auth/protected', [
    'middleware' => 'auth',
    function () {
        return '다시오신것을 환영합니다, ' . Auth::user()->name;
    }
]);

Route::get('login', function() {
    return "로그인 페이지 입니다.";
});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@provider');

Route::get('home', [
    'middleware' => 'auth',
    function() {
        return 'Welcome back, ' . Auth::user()->name;
    }
]);

/* 메일 보내기 테스트 */
Route::get('mail/{mailto}', 'MailController@sendMail');