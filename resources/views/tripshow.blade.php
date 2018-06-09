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

	<h2 id="items">TRIP items</h2>
	<table class="table table-bordered table-hover">
		<tr class="table-active">
			<th class="t_slim" style="width: 50%;">name</th>
			<th class="t_slim" style="width: 25%;">status</th>
			<th class="t_slim" style="width: 25%;">cost</th>
		</tr>
		@foreach($items_data as $item)
			<tr id="/itemshow?id={{$item->id}}">
				<td class="item_row_link">{{$item->name}}</td>
				<td class="hover_input_trigger">
					<form action="/itemstatusupdate" method="POST">
						<span class="now_content">{{$ITEMS_STATUS[$item->status]}}</span>
						<select name="item_status" class="hover_input not_changed" id="item_status">
								<option value="">--</option>
							@foreach ($ITEMS_STATUS as $key => $status)
								<?php $selected = ( $key == $item->status)? " selected ": "";?>
								<option value="{{$key}}"{{$selected}}>{{$status}}</option>
							@endforeach
						</select>
						<input type="hidden" name="id" value="{{$item->id}}">
					</form>
				</td>
				<td class="t_head item_row_link">{{$item->cost}} えん</td>
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
		$('.not_changed').hide();
		$('.item_row_link').on('click', function(){
			// テーブルの行クリックで飛ばす
			var link_target = $(this).parent().attr('id');
			//console.log(link_target);
			window.location = link_target;
		});


		$('.hover_input_trigger').hover(function(){
			//console.log('hover');
			$(this).find('.hover_input').show();
			$(this).find('.now_content').hide();
		}, 
		function(){
			$(this).find('.not_changed').hide();
			if($(this).find('.not_changed').length > 0){
				$(this).find('.now_content').show();
			}
		});

		$('select[name=item_status]').change(function(){
			//console.log('test');
			var after_status = $(this).val();
			var form = $(this).parent();
			var item_id = form.find('input[name=item_id]').val();
			console.log(form);
			form.submit();
		});

		function isChange(){ // 変更があるか調べ、あればnot_changedクラスを外して表示
			$('.not_changed').change(function(){
				$(this).removeClass('not_changed').show();
				$(this).siblings('.now_content').removeClass('.now_content').hide();

				//console.log($(this).val());
			});
		}
	});
</script>
@endsection