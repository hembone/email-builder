@extends('layouts.master')
@section('content')

<div class="container-fluid">

<h3>Manage</h3>

@if ($success)
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  {{ $success }}
</div>
@endif
@if ($fail)
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  {{ $fail }}
</div>
@endif

<div class="col-md-9">
	<div style="display:none;" id="blocks_container"></div>
</div>
<div class="col-md-3">
	<a class="btn btn-success btn-block" href="/new-block"><i class="fa fa-plus"></i> New Block</a>
	<a class="btn btn-default btn-block" href="/categories"><i class="fa fa-pencil"></i> Edit Categories</a>
	<a class="btn btn-default btn-block" href="/brands"><i class="fa fa-pencil"></i> Edit Brands</a>
</div>

</div><!-- end .container-fluid -->

<div id="confirm_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure?</h4>
			</div>
			<div class="modal-body">
				<div class="col-sm-6">
					<button type="button" class="btn btn-danger btn-block" data-dismiss="modal"><i class="fa fa-ban"></i> No Way!</button>
				</div>
				<div class="col-sm-6">
					<form method="post" action="/delete-block">
					<input id="delete_id" name="delete_id" type="hidden">
					<button type="submit" class="btn btn-success btn-block"><i class="fa fa-check"></i> Yes</button>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

@stop

@section('scripts')

<script>

$(function() {

	MANAGE.init();

});

var MANAGE = {

	init : function() {
		MANAGE.get();
	},

	get : function() {
		$.ajax({
			type: 'post'
			,url: 'blocks'
			,dataType: 'json'
			,data: 'filters'
		}).done(function( res ) {
			//console.log(res);
			MANAGE.display(res);
		});
	},

	display : function(blocks) {
		var html = '';
		$.each(blocks, function(index, block) {
			var block_div = '<div class="block_name">'+block.name+'</div>';
			block_div += '<div id="'+block.id+'" class="block_wrap">';
			block_div += '<div class="block_controls"><button onclick="MANAGE.setId('+block.id+')" data-toggle="modal" data-target="#confirm_modal" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button><a class="btn btn-primary btn-xs" href="/edit-block/'+block.id+'"><i class="fa fa-pencil"></i> Edit</a></div>';
			block_div += '<iframe id="iframe_'+block.id+'" scrolling="no" seamless="seamless"></iframe>';
			block_div += '</div>';
			html += block_div;
		});
		$('#blocks_container').html(html);
		$.each(blocks, function(index, block) {
			var doc = document.getElementById('iframe_'+block.id).contentWindow.document;
			doc.open();
			doc.write('<style>'+block.css+'</style>');
			doc.write(block.code);
			doc.close();
		});
		$('#blocks_container').fadeIn();
		MANAGE.setListeners();
	},

	setListeners : function() {
		$('.block_wrap').on('mouseover', function() {
			var blockId = this.id;
			var height = $('#iframe_'+blockId).contents().find('html').height();
			$('#iframe_'+blockId).clearQueue();
			$('#iframe_'+blockId).animate({
				height: height
			}, 300);
		});
		$('.block_wrap').on('mouseout', function() {
			var blockId = this.id;
			$('#iframe_'+blockId).clearQueue();
			$('#iframe_'+blockId).animate({
				height: '100px'
			}, 300);
		});
	},

	setId : function(id) {
		$('#delete_id').val(id);
	}

};

</script>

@stop