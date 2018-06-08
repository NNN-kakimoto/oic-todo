@extends('./layouts/common')
@section('title', $title)
@section('content')
<article class="col-sm-8 main_content">
	<h2>ITEM details</h2>
	<form action="/itemupdate" id="item_form" method="POST">
		<?= csrf_field() ?>
		<ul>
			<li class="hover_input_trigger">name :<span class="now_content">{{$item_data->name}}</span>
				<input type="text" name="item_name" class="hover_input not_changed" id="item_name" value="{{$item_data->name}}"></li>
			<li class="hover_input_trigger">status :<span class="now_content">{{$ITEMS_STATUS[$item_data->status]}}</span>
				<select name="item_status" class="hover_inout not_changed" id="item_status">
					<option value="">--</option>
					@foreach ($ITEMS_STATUS as $key => $status)
						<?php $selected = ( $key == $item_data->status)? " selected ": "";?>
						<option value="{{$key}}"{{$selected}}>{{$status}}</option>
					@endforeach
				</select>
			</li>
			<li class="hover_input_trigger">cost :<span class="now_content">{{$item_data->cost}}</span>
				<input type="number" name="item_cost" class="hover_input not_changed" id="item_cost" value="{{$item_data->cost}}"> えん</li>
		</ul>
	
		<input type="hidden" name="id" value="{{$item_data->item_id}}">
		<input type="hidden" name="delete_flg" value="0" id="delete_flg">
		<button type="button" name="update" id="update_btn" class="submit_btn" >こうしん</button>
		<button type="button" name="delete" id="delete_btn" class="submit_btn" >さくじょ</button>	
	</form>

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
		$('.submit_btn').on('click', function(){
			if($(this).attr('id') == 'delete_btn'){
				// 削除フラグを1に
				$("#delete_flg").val(1);
				console.log($("#delete_flg").val());
			}
			$('#item_form').submit();
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