<html>
	<head>
		<meta charset="utf-8">
		<script src="/js/jquery-3.2.1.min.js"></script>
	</head>
	
	<body>
		<header>
			<h1>TOrip DOrist</h1>
		</header>
		<article>
			<h2>TRIP details</h2>
			<ul>
				<li>name :{{$trip_data->name}}</li>
				<li>target :{{$trip_data->target}}</li>
				<li>total cost :{{$trip_data->total_cost}}</li>
			</ul>

			<h2>TRIP items</h2>
			<ul>
				@foreach($items_data as $item)
					<li><a href="/itemshow?id={{$item->id}}">{{$item->name}} : {{$ITEMS_STATUS[$item->status]}} : {{$item->cost}}</a>{{-- <a class="delete-btn" id="delete{{$item->id}}">✕</a>--}}</li>
				@endforeach
			</ul>

			<h2>TRIP item add</h2>
			<form action="/task" method="POST">
				<?= csrf_field() ?>
				<input type="text" name="task_name" placeholder="なまえ">
				<input type="number" name="cost" placeholder="よさん" value="">えん{{--input type number なので'やばたにえん'とかは入れれない--}}
				<input type="hidden" name="trip_id" value="{{$trip_data->id}}">
				<input type="text" readonly value="{{$trip_data->name}}">
				</select>
				<input type="submit" value="あいてむついか">
			</form>
			<a href="/triplist">もどる</a>
		</article>
	</body>
	<script>
		$(function(){
			$('.delete-btn').click(function(){
				var id = $(this).attr('id');
				var item_id = id.slice(6,9);
				console.log(item_id);

			})
		});
	</script>
</html>