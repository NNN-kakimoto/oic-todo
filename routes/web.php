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
	$tasks = DB::select("select i.id, i.name as name, i.status, t.name as trip_name from items as i join trips as t on i.trip_id = t.id");
	$trips = DB::select("select id, name from trips");
	$ITEMS_STATUS = Config::get('const.ITEMS_STATUS'); 
	//var_dump($ITEMS_STATUS); exit;
	// $tasks = ["test"];
	return view("tasklist", [
		"message" => "hello, world",
		"tasks" => $tasks,
		"trips" => $trips,
		"ITEMS_STATUS" => $ITEMS_STATUS
	]);
});
Route::get('/triplist', function(){
	$trips = DB::select("select * from trips");
	//var_dump($trips);exit;
	return view("triplist", [
		"trips" => $trips
	]);
});
Route::post("/task", function(){
	$taskName = request()->get("task_name");
	$tripId = request()->get("trip_id");
	$status = intval(request()->get("status"));
	if(empty($taskName) || empty($tripId)){ //一時的にバリデートっぽくしておく
		return redirect("/tasklist");
	}
	// return var_dump($taskName);
	DB::insert("insert into items (name, status, cost, trip_id) values(?,?,?,?)", [$taskName, $status, 0, $tripId]);
	return redirect("/tasklist");
});
Route::post("/trip", function(){
	$tripName = request()->get("trip_name");
	$tripTarget = request()->get("trip_target");
	DB::insert("insert into trips (name, target, total_cost, is_finished) values (?,?,?,?)", [$tripName, $tripTarget, 0, false]);
	return redirect("/triplist");
});
Route::get("/params_test", function(){
	$title = request()->get("title");
	return $title;
});