<html>
	<head>
		<meta charset="utf-8">
		<script src="../assets/js/jquery-3.2.1.min.js"></script>
	</head>
	
	<body>
		<header>
			<h1>TOrip DOrist</h1>
		</header>
		<article>
			<ul>
				@foreach($trips as $trip)
					<li><a href="/tripshow?id={{$trip->id}}">{{$trip->name}} : {{$trip->target}}</a></li>
				@endforeach
			</ul>
			<?php // var_dump($tasks); ?>

			<h2>TRIP List</h2>
			<form action="/trip" method="POST">
				<?= csrf_field() ?>
				<input type="text" name="trip_name" placeholder="なまえ">
				<input type="text" name="trip_target" placeholder="もくてきち">
				<input type="submit" name="trip_add" value="ついかする">
			</form>
		</article>
	</body>
</html>