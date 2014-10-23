@extends('layouts.master')
@section('content')

<div class="container-fluid">

<h3>Edit Brands</h3>

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
	@foreach ($brands as $brand)
	<div class="brand_box">
		<div id="brand_{{ $brand->id }}">
			<span>{{ $brand->name }}</span>
			<div class="brand_controls">
				<button class="btn btn-danger btn-sm" onclick="BRAND.setId({{ $brand->id }});" data-toggle="modal" data-target="#confirm_modal"><i class="fa fa-trash"></i></button>
				<button class="btn btn-primary btn-sm" onclick="BRAND.edit({{ $brand->id }});"><i class="fa fa-pencil"></i> Edit</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<div style="display:none;" id="form_{{ $brand->id }}">
			<form class="form-inline pull-left" method="post" action="/edit-brand">
				<input type="hidden" name="brand_id" value="{{ $brand->id }}">
				<div class="form-group">
					<input class="form-control input-sm" type="text" name="name" value="{{ $brand->name }}">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check"></i> Save Brand</button>
				</div>
			</form>
			<div class="brand_controls">
				<button class="btn btn-default btn-sm" onclick="BRAND.cancelEdit({{ $brand->id }});"><i class="fa fa-close"></i> Cancel</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	@endforeach
</div>
<div class="col-md-3">
	<form method="post" action="/edit-brand">
		<div class="form-group">
			<input class="form-control" type="text" name="name" placeholder="Brand Name...">
		</div>
		<div class="form-group">
			<button class="btn btn-success btn-block" type="submit"><i class="fa fa-plus"></i> Create Brand</button>
		</div>
	</form>
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
					<form method="post" action="/delete-brand">
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

var BRAND = {

	edit : function(id) {
		$('#brand_'+id).hide();
		$('#form_'+id).fadeIn();
	},

	cancelEdit : function(id) {
		$('#form_'+id).hide();
		$('#brand_'+id).fadeIn();
	},

	setId : function(id) {
		$('#delete_id').val(id);
	}

};

</script>

@stop