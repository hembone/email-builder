@extends('layouts.master')
@section('content')

<div class="container-fluid">

<h3>Edit Categories</h3>

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
	@foreach ($categories as $category)
	<div class="category_box">
		<div id="category_{{ $category->id }}">
			<span>{{ $category->name }}</span>
			<div class="category_controls">
				<button class="btn btn-danger btn-sm" onclick="CAT.setId({{ $category->id }});" data-toggle="modal" data-target="#confirm_modal"><i class="fa fa-trash"></i></button>
				<button class="btn btn-primary btn-sm" onclick="CAT.edit({{ $category->id }});"><i class="fa fa-pencil"></i> Edit</button>
			</div>
			<div class="clearfix"></div>
		</div>
		<div style="display:none;" id="form_{{ $category->id }}">
			<form class="form-inline pull-left" method="post" action="/edit-category">
				<input type="hidden" name="category_id" value="{{ $category->id }}">
				<div class="form-group">
					<input class="form-control input-sm" type="text" name="name" value="{{ $category->name }}">
				</div>
				<div class="form-group">
					<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check"></i> Save Category</button>
				</div>
			</form>
			<div class="category_controls">
				<button class="btn btn-default btn-sm" onclick="CAT.cancelEdit({{ $category->id }});"><i class="fa fa-close"></i> Cancel</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	@endforeach
</div>
<div class="col-md-3">
	<form method="post" action="/edit-category">
		<div class="form-group">
			<input class="form-control" type="text" name="name" placeholder="Category Name...">
		</div>
		<div class="form-group">
			<button class="btn btn-success btn-block" type="submit"><i class="fa fa-plus"></i> Create Category</button>
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
					<form method="post" action="/delete-category">
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

var CAT = {

	edit : function(id) {
		$('#category_'+id).hide();
		$('#form_'+id).fadeIn();
	},

	cancelEdit : function(id) {
		$('#form_'+id).hide();
		$('#category_'+id).fadeIn();
	},

	setId : function(id) {
		$('#delete_id').val(id);
	}

};

</script>

@stop