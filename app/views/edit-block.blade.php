@extends('layouts.master')

@section('styles')

@stop

@section('content')

<div class="container-fluid">

<h3>{{ $title }}</h3>

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

<form id="new_block_form" role="form" method="post" action="edit-block">

	<div class="col-md-8">
		<div style="display:none;" id="edit_box">
			<div class="form-group">
				<label for="name">CSS</label>
				<div id="css_ace">{{ isset($block->css)?$block->css:'' }}</div>
				<textarea style="display:none;" id="css" name="css">{{ isset($block->css)?$block->css:'' }}</textarea>
			</div>
			<div class="form-group">
				<label for="name">HTML</label>
				<div id="code_ace">{{ isset($block->code)?$block->code:'' }}</div>
				<textarea style="display:none;" id="code" name="code">{{ isset($block->code)?$block->code:'' }}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<input type="hidden" name="block_id" value="{{ isset($block->id)?$block->id:'' }}">
		<div class="form-group">
			<label for="name">Name</label>
			<input id="name" class="form-control" type="text" name="name" value="{{ isset($block->name)?$block->name:'' }}">
		</div>
		<div class="form-group">
			<label for="category">Category</label>
			<select id="category" class="form-control" name="category">
				<option value="">None</option>
				@foreach ($categories as $category)
					<option value="{{ $category->id }}" {{ isset($block->category_id)&&$block->category_id===$category->id?'selected':'' }}>{{ $category->name }}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label for="brand">Brand</label>
			<select id="brand" class="form-control" name="brand">
				<option value="">None</option>
				@foreach ($brands as $brand)
					<option value="{{ $brand->id }}" {{ isset($block->brand_id)&&$block->brand_id===$brand->id?'selected':'' }}>{{ $brand->name }}</option>
				@endforeach
			</select>
		</div>
		@if (isset($block))
		<div class="form-group">
			<div id="filelist"></div>
			<div id="upload_box">
				<button id="pickfiles" class="btn btn-default btn-block" type="button"><i class="fa fa-image"></i> Select Images</button>
			</div>
		</div>
		<div class="form-group">
			<button style="display:none;" id="uploadfiles" class="btn btn-success btn-block" type="button"><i class="fa fa-upload"></i> Upload Images</button>
		</div>
		<div class="form-group">
			<button onclick="$('#confirm_modal').modal('show');" class="btn btn-danger btn-block" type="button"><i class="fa fa-trash"></i> Delete Block</button>
		</div>
		@endif
		<div class="form-group">
			<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-check"></i> Save Block</button>
		</div>
	</div>

</form>

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
					<input name="delete_id" type="hidden" value="{{ isset($block->id)?$block->id:'' }}">
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

{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js'); }}
{{ HTML::script('assets/js/plupload/plupload.full.min.js'); }}

<script>

$(function() {

	BLOCK.init();
	UPLOADER.init();
	$('#edit_box').fadeIn();

});

var BLOCK = {

    init : function() {
        var cssAce = ace.edit("css_ace");
        cssAce.setTheme("ace/theme/monokai");
        cssAce.getSession().setMode("ace/mode/css");
        cssAce.session.setUseWorker(false);
        cssAce.setValue($('#css').val(), 1);

        var codeAce = ace.edit("code_ace");
        codeAce.setTheme("ace/theme/monokai");
        codeAce.getSession().setMode("ace/mode/html");
        codeAce.session.setUseWorker(false);
        codeAce.setValue($('#code').val(), 1);

        $('#new_block_form').on('submit', function(event) {
            var css = cssAce.getValue();
            $('#css').val(css);
            var code = codeAce.getValue();
            $('#code').val(code);
        });
    }

};

var UPLOADER = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'pickfiles', // you can pass in id...
	container: document.getElementById('upload_box'), // ... or DOM Element itself
	url : '/upload/{{ isset($block->id)?$block->id:'' }}',
	flash_swf_url : 'assets/js/plupload/Moxie.swf',
	silverlight_xap_url : 'assets/js/plupload/Moxie.xap',
	
	filters : {
		max_file_size : '10mb',
		mime_types: [
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Zip files", extensions : "zip"}
		]
	},

	init: {
		PostInit: function() {
			document.getElementById('filelist').innerHTML = '';

			document.getElementById('uploadfiles').onclick = function() {
				UPLOADER.start();
				$('#uploadfiles').hide();
				return false;
			};
		},

		FilesAdded: function(up, files) {
			$('#uploadfiles').show();
			plupload.each(files, function(file) {
				$('#filelist').html('<div id="'+file.id +'">'+file.name +' ('+plupload.formatSize(file.size)+') <b></b></div><div id="bar_'+file.id+'" class="progress_wrap"></div>');
			});
		},

		UploadProgress: function(up, file) {
			$('#bar_'+file.id).html('<span style="width:'+file.percent+'%;" class="progress_bar"></span>');
		},

		UploadComplete: function() {
			$('#filelist').html('');
		},

		Error: function(up, err) {
			console.log("Error #" + err.code + ": " + err.message);
		}
	}
});

</script>

@stop