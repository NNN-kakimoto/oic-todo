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
			<h2>ITEM details</h2>
			<ul>
				<li>name :{{$item_data->name}}</li>
				<li>status :{{$ITEMS_STATUS[$item_data->status]}}</li>
				<li>cost :{{$item_data->cost}}</li>
			</ul>

			<h2>TRIP details</h2>
			<ul>
				<li>name :{{$trip_data->name}}</li>
				<li>target :{{$trip_data->target}}</li>
				<li>total cost :{{$trip_data->total_cost}}</li>
			</ul>

			<h2>othser TRIP items</h2>
			<ul>
				@foreach($items_data as $item)
					<li>{{$item->name}} : {{$ITEMS_STATUS[$item->status]}} : {{$item->cost}}</li>
				@endforeach
			</ul>

			<a href="/tripshow?id={{$trip_data->id}}">もどる</a>
		</article>
	</body>
</html>