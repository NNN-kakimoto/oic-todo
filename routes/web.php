<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hoge', function () {
	return view('html/trip');
});
Route::get('/tasklist', function () {
	return view('html',
		["message" => "testtest",
			"tasks" => [
				'Goto Bookstore',
				'Clean myroom',
			]
		]
	);
});
Route::post("/task", function(){
	$taskName = request()->get("task_name");
	return "hello, {$taskName}.";
});
Route::get("/params_test", function(){
	$title = request()->get("title");
	return $title;
});