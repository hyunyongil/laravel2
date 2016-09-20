<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImplicitController extends Controller
{
    public function getCollection()
    {
        // 위 코드 추가
		$collection = collect([1, 'apple', '', 'banana', null, 3]) // 1
		->map(function ($name) { //2
			return strtoupper($name);
		})
		->reject(function ($name) {  //3
			return is_numeric($name);
		})
		->reject(function ($name) {  //4
			return empty($name);
		});
        return dump($collection);
    }
}
