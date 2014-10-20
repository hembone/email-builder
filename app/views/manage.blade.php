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
	<a class="btn btn-primary btn-block" href="new-block"><i class="fa fa-plus"></i> New Block</a>
	<a class="btn btn-default btn-block" href="edit-categories"><i class="fa fa-cog"></i> Edit Categories</a>
	<a class="btn btn-default btn-block" href="edit-brands"><i class="fa fa-cog"></i> Edit Brands</a>
</div>

</div><!-- end .container-fluid -->

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
			var block_div = '<div id="block_'+block.id+'" class="block_wrap">';
			block_div += '<iframe id="iframe_'+block.id+'"></iframe>';
			block_div += '</div>';
			html += block_div;
		});
		$('#blocks_container').html(html).fadeIn();
	}

};

</script>

@stop