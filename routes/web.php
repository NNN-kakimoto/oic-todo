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
	$trips = DB::select("select * from trips order by id desc");
	//var_dump($trips);exit;
	return view("triplist", [
		"trips" => $trips
	]);
});
Route::get('/hoge', function () {
	return view('hoge');
});
Route::get('/tasklist', function () {
	$tasks = DB::select("select i.id, i.name as name, i.status,i.cost, t.name as trip_name from items as i join trips as t on i.trip_id = t.id");
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
	$trips = DB::select("select * from trips order by id desc");
	//var_dump($trips);exit;
	return view("triplist", [
		"trips" => $trips
	]);
});
Route::post("/task", function(){
	$taskName = request()->get("task_name");
	$cost = intval(request()->get("cost"));
	$tripId = request()->get("trip_id");
	$status = intval(request()->get("status"));
	if(empty($taskName) || empty($tripId)){ //一時的にバリデートっぽくしておく
		return redirect("/tasklist");
	}
	if($cost != 0){ //costが0じゃない時tripテーブルもUPDATEする
		$old_cost = DB::select('select total_cost from trips where id = ? limit 1', [$tripId]);
		$new_cost = $old_cost[0]->total_cost += $cost;
		//var_dump($new_cost);exit;
		DB::update('update trips set total_cost = ? where id = ?', [$new_cost, $tripId]);
	}
	// return var_dump($taskName);
	DB::insert("insert into items (name, status, cost, trip_id) values(?,?,?,?)", [$taskName, $status, $cost, $tripId]);
	return redirect()->to("/tripshow?id={$tripId}");
});
Route::post("/trip", function(){
	$tripName = request()->get("trip_name");
	$tripTarget = request()->get("trip_target");
	DB::insert("insert into trips (name, target, total_cost, is_finished) values (?,?,?,?)", [$tripName, $tripTarget, 0, false]);
	return redirect("/triplist");
});

// single content page
Route::get("/tripshow", function(){
	$tripId = intval(request()->get("id"));
	$trip_data = DB::select('select * from trips where id = ? limit 1', [$tripId]);
	$items_list = DB::select('select * from items where trip_id = ?', [$tripId]);
	$ITEMS_STATUS = Config::get('const.ITEMS_STATUS'); 
	return view("tripshow",[
		"trip_data" => $trip_data[0],
		"items_data" => $items_list,
		"ITEMS_STATUS" => $ITEMS_STATUS
	]);
});
Route::get("/itemshow", function(){
	$itemId = intval(request()->get("id"));
	$item_data = DB::select('select i.id as item_id, i.name, t.id as trip_id, i.cost, i.status from items as i join trips as t on i.trip_id = t.id where i.id = ? limit 1', [$itemId]);
	$trip_data = DB::select('select * from trips where id = ? limit 1', [$item_data[0]->trip_id]);
	$items_list = DB::select('select * from items where trip_id = ?', [$item_data[0]->trip_id]);
	$ITEMS_STATUS = Config::get('const.ITEMS_STATUS'); 
	return view("itemshow",[
		"item_data" => $item_data[0],
		"trip_data" => $trip_data[0],
		"items_data" => $items_list,
		"ITEMS_STATUS" => $ITEMS_STATUS
	]);
});


// content delete
Route::post("/itemupdate", function(){
	//var_dump($_POST);exit;
	$itemId = intval(request()->get("id"));
	$item = DB::select('select * from items where id = ? limit 1', [$itemId]);
	$delete_flg = intval(request()->get("delete_flg"));
	//var_dump($item, $delete_flg);exit;
	if($delete_flg === 1 && !empty($item)){
		// delete submit かつ 項目存在
		$tripId = $item[0]->trip_id;
		$deleted = DB::delete('delete from items where id = ? limit 1', [$itemId]);
		return redirect()->to("/tripshow?id={$tripId}");
	}else if($delete_flg === 0 && !empty($item)){
		// update submit かつ 項目存在
		//$tripId = $item[0]->trip_id;
		$new_name = request()->get("item_name");
		$new_status = intval(request()->get("item_status"));
		$new_cost = intval(request()->get("item_cost"));
		$new_cost = $new_cost==NULL? 0: $new_cost;
		$updated = DB::update('update items set name = ?, status = ?, cost = ? where id = ? limit 1',[$new_name, $new_status, $new_cost, $itemId]);
		return redirect()->to("/itemshow?id={$itemId}");
	}else{
		return redirect("/tasklist");
	}
});

Route::get("/params_test", function(){
	$title = request()->get("title");
	return $title;
});