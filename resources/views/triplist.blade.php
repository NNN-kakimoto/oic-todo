@extends('./layouts/common')
@section('title', $title)
@section('content')
<article class="col-sm-8 main_content">
	<h2>TRIP List</h2>
	<table class="table table-bordered table-hover">
		<tr class="table-active">
			<th class="t_slim" style="width: 50%;">name</th>
			<th class="t_slim" style="width: 25%;">target</th>
			<th class="t_slim" style="width: 25%;">total cost</th>
		</tr>
		@foreach($trips as $trip)
			<tr class="item_row_link" id="/tripshow?id={{$trip->id}}">
				<td>{{$trip->name}}</td>
				<td>{{$trip->target}}</td>
				<td class="t_head">{{$trip->total_cost}} えん</td>
			</tr>
		@endforeach
	</table>
	
	<h2>TRIP add</h2>
	<form action="/trip" method="POST"  class="form-horizontal">
		<?= csrf_field() ?>
		<div class="form-group">
			<div class="col-sm-12 form-inline">
				<input type="text" name="trip_name"  class="form-control"  placeholder="なまえ">
				<input type="text" name="trip_target" class="form-control"  placeholder="もくてきち">
				<input type="submit" class="btn" name="trip_add" value="ついかする">
			</div>
		</div>
	</form>
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
{{-- <html>
	<head>
		<meta charset="utf-8">
		<script src="../assets/js/jquery-3.2.1.min.js"></script>
	</head>
	
	<body>
		<header>
			<h1>TOrip DOrist</h1>
		</header>
		
	</body>
</html> --}}