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
	<div class="">
		{{ $category->name }}


	</div>
	@endforeach
</div>
<div class="col-md-3">
	<form method="post" action="/edit-category">
		<div class="form-group">
			<input class="form-control" type="text" name="name" placeholder="New Category">
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Save Category</button>
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

@stop