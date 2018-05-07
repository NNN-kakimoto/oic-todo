<?php
echo "test<br>";

?>
<?= date("Y-m-d")."<br>"; ?>
<h1><?= $message ?></h1>
<ul>
	@foreach($tasks as $task)
		<li>{{$task}}</li>
	@endforeach
</ul>

<table>
	<tr>
		@for($i=1; $i<31; $i++)
			<td>{{$i}}</td>
			@if(($i)%6 == 0 && $i != 1)
			</tr><tr>
			@endif
		@endfor
		</tr>
</table>

<h2>2018年4月のカレンダーを書くよ！</h2>
<s>たまたま4月が1日始まりだっただけ</s><br><br>
<table>
	<tr>
		<th>Sun</th>
		<th>Mon</th>
		<th>Tue</th>
		<th>Wed</th>
		<th>Thu</th>
		<th>Fri</th>
		<th>Sat</th>
	</tr>
	<tr>
	@for($i=1; $i<31; $i++)
		<td>{{$i}}</td>
		@if(($i)%7 == 0 && $i != 1)
		</tr><tr>
		@endif
	@endfor
	</tr>
</table>

<form action="/task" method="POST">
	<?= csrf_field() ?>
	<input type="text" name="task_name">
	<input type="submit" value="タスクの追加">
</form>