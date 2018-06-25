@extends('./layouts/common')
@section('title', $title)
@section('content')
<article class="col-sm-8 main_content">
	<h2>TRIP details</h2>
	<form action="/tripupdate" method="POST">
		<?= csrf_field() ?>
		<table class="table table-bordered">
			<tr>
				<td class="t_head">name</td>
				<td class="hover_input_trigger">
					<span class="now_content">{{$trip_data->name}}</span>
					<input type="text" name="trip_name" class="hover_input not_changed form-control" id="item_name" value="{{$trip_data->name}}">
				</td>
			</tr>
			<tr>
				<td class="t_head">target</td>
				<td class="hover_input_trigger">
					<span class="now_content">{{$trip_data->target}}</span>
					<input type="text" name="trip_target" class="hover_input not_changed form-control" id="item_name" value="{{$trip_data->target}}">
					</td>
			</tr>
			<tr>
				<td class="t_head">total cost</td>
				<td class="hober_disable_input">
					<span class="">{{$trip_data->total_cost}}</span>えん<span class="disable_text">※total costはにもつのよさんによって変動するので、変更できません。</span>
				</td>
			</tr>
		</table>
		<input type="hidden" name="trip_id" value="{{$trip_data->id}}" >
		<input type="submit" name="update" value="こうしん" id="update-btn" class="btn update-btn">
		<button type="button" class="btn" id="delete_btn">さくじょ</button>
	</form>
	<form id="delete_form" action="/tripdelete" method="POST">
		<?= csrf_field() ?>
		<input type="hidden" name="id" value="{{$trip_data->id}}" >
		<input type="hidden" name="delte" value="さくじょ" id="delete-btn" class="btn delete-btn">
	</form>

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
						<?= csrf_field() ?>
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
	<form action="/task" method="POST"  class="form-horizontal">
		<?= csrf_field() ?>
		<div class="form-group">
			<div class="col-sm-12 form-inline">
				<input type="text" name="task_name" class="form-control"  placeholder="なまえ">
				<input type="number" name="cost"  class="form-control" placeholder="よさん" value="">えん{{--input type number なので'やばたにえん'とかは入れれない--}}
			</div>
			<input type="hidden" name="trip_id" value="{{$trip_data->id}}">
			<div class="col-sm-12">
				<input type="text" class="form-control" readonly value="{{$trip_data->name}}">
			</div>
			<div class="col-sm-12">
				<input type="submit" class="btn" value="あいてむついか">
			</div>
		</div>
	</form>
	<a class="link" href="/triplist">もどる</a>
</article>


<script>
	$(function(){
		$('.not_changed').hide();
		$('.disable_text').hide();
		$('.item_row_link').on('click', function(){
			// テーブルの行クリックで飛ばす
			var link_target = $(this).parent().attr('id');
			//console.log(link_target);
			window.location = link_target;
		});

		// delete form submit
		$('#delete_btn').click(function(){
			$('#delete_form').submit();
		});

		$('.hober_disable_input').hover(function(){
			$('.disable_text').show();
		},
		function(){
			$('.disable_text').hide();
		});


		$('.hover_input_trigger').hover(function(){
			//console.log('hover');
			$(this).find('.hover_input').show().css('height','19px');
			$(this).find('.now_content').hide();
			isChange();
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
			console.log("test");
			$('.not_changed').change(function(){
				$(this).removeClass('not_changed').show();
				$(this).siblings('.now_content').removeClass('.now_content').hide();
				//console.log($(this).val());
			});
		}
	});
</script>
@endsection