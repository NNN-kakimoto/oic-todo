@extends('./layouts/common')
@section('title', $title)
@section('content')
<article class="col-sm-8 main_content">
	<h2>TRIP details</h2>
	<table class="table table-bordered">
		<tr>
			<td class="t_head">name</td>
			<td>{{$trip_data->name}}</td>
		</tr>
		<tr>
			<td class="t_head">target</td>
			<td>{{$trip_data->target}}</td>
		</tr>
		<tr>
			<td class="t_head">total cost</td>
			<td>{{$trip_data->total_cost}} えん</td>
		</tr>
	</table>

	<h2>TRIP items</h2>
	<table class="table table-bordered table-hover">
		<tr class="table-active">
			<th class="t_slim" style="width: 50%;">name</th>
			<th class="t_slim" style="width: 25%;">status</th>
			<th class="t_slim" style="width: 25%;">cost</th>
		</tr>
		@foreach($items_data as $item)
			<tr class="item_row_link" id="/itemshow?id={{$item->id}}">
				<td>{{$item->name}}</td>
				<td>{{$ITEMS_STATUS[$item->status]}}</td>
				<td class="t_head">{{$item->cost}} えん</td>
			</a></tr>
		@endforeach
	</table>

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
	<a class="link" href="/triplist">もどる</a>
</article>


<script>
	$(function(){
		$('.item_row_link').on('click', function(){
			var link_target = $(this).attr('id');
			//console.log(link_target);
			window.location = link_target;
		});
	});
</script>
@endsection