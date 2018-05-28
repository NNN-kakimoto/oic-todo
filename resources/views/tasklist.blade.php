<h1>TOrip DOrist</h1>
<ul>
	@foreach($tasks as $task)
		<li>{{$task->name}} : {{$task->trip_name}} : {{$ITEMS_STATUS[$task->status]}}</li>
	@endforeach
</ul>

<form action="/task" method="POST">
	<?= csrf_field() ?>
	<input type="text" name="task_name" placeholder="なまえ">
	<select name="trip_id">
		<option value>--</option>
		@foreach ($trips as $trip)
			<option value="{{$trip->id}}">{{$trip->name}}</option>
		@endforeach
	</select>
	<select name="status">
		<option value>--</option>
		@foreach ($ITEMS_STATUS as $key => $status)
			<option value="{{$key}}">{{$status}}</option>
		@endforeach
	</select>
	<input type="submit" value="あいてむついか">
</form>