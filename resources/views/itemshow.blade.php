@extends('./layouts/common')
@section('title', $title)
@section('content')
<article class="col-sm-8 main_content">
	<h2>ITEM details</h2>
	<form action="/itemupdate" id="item_form" method="POST">
		<?= csrf_field() ?>
		<table class="table table-bordered">
			<tr>
				<td class="t_head">name</td>
				<td class="hover_input_trigger">
					<span class="now_content">{{$item_data->name}}</span>
					<input type="text" name="item_name" class="hover_input not_changed" id="item_name" value="{{$item_data->name}}">
				</td>
			</tr>
			<tr>
				<td class="t_head">status</td>
				<td class="hover_input_trigger" >
					<span class="now_content">{{$ITEMS_STATUS[$item_data->status]}}</span>
					<select name="item_status" class="hover_inout not_changed" id="item_status">
						<option value="">--</option>
						@foreach ($ITEMS_STATUS as $key => $status)
							<?php $selected = ( $key == $item_data->status)? " selected ": "";?>
							<option value="{{$key}}"{{$selected}}>{{$status}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td class="t_head">cost</td>
				<td class="hover_input_trigger">
					<span class="now_content">{{$item_data->cost}}</span>
					<input type="number" name="item_cost" class="hover_input not_changed" id="item_cost" value="{{$item_data->cost}}"> えん
				</td>
			</tr>
		</table>
	
		<input type="hidden" name="id" value="{{$item_data->item_id}}">
		<input type="hidden" name="delete_flg" value="0" id="delete_flg">
		<input  class="btn" type="submit" name="update" id="update_btn" value="こうしん" >
	</form>
	<form action="/itemdelete" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="{{$item_data->item_id}}">
		<input class="btn" type="submit" name="delete"value="さくじょ">	
	</form>	

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

	<h2>othser TRIP items</h2>
	<table class="table table-bordered table-hover">
		<tr class="table-active">
			<th class="t_slim" style="width: 50%;">name</th>
			<th class="t_slim" style="width: 25%;">status</th>
			<th class="t_slim" style="width: 25%;">cost</th>
		</tr>
		@foreach($items_data as $item)
			<tr id="/itemshow?id={{$item->id}}">
				<td class="item_row_link">{{$item->name}}</td>
				<td class="item_row_link">{{$ITEMS_STATUS[$item->status]}}</td>
				<td class="t_head item_row_link">{{$item->cost}} えん</td>
			</a></tr>
		@endforeach
	</table>

	<a class="link" href="/tripshow?id={{$trip_data->id}}">もどる</a>
</article>
<script>
	$(function(){
		// ページロード時、not_changedクラスを非表示
		$('.not_changed').hide();

		$('.hover_input_trigger').hover(function(){
			//console.log('hover');
			$(this).children().show();
			$(this).children('.now_content').hide();
		}, 
		function(){
			//console.log('unhover');
			isChange();
			$(this).children('.not_changed').hide();
			if($(this).children('.not_changed').length > 0){
				$(this).children('.now_content').show();
			}
		});

		// submitボタンの実装(buttonタグなので)
		$('.submit_btn').click( function(){
			console.log('aa');
			if($(this).attr('id') == 'delete_btn'){
				// 削除フラグを1に
				$("#delete_flg").val(1);
				console.log($("#delete_flg").val());
			}
			$('#item_form').submit();
		});

		$('.item_row_link').on('click', function(){
			// テーブルの行クリックで飛ばす
			var link_target = $(this).parent().attr('id');
			//console.log(link_target);
			window.location = link_target;
		});


		function isChange(){ // 変更があるか調べ、あればnot_changedクラスを外して表示
			$('.not_changed').change(function(){
				$(this).removeClass('not_changed').show();
				$(this).siblings('.now_content').removeClass('.now_content').hide();
			});
		}
	});
</script>
@endsection