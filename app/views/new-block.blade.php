@extends('layouts.master')
@section('content')

<h3>New Block</h3>

<form method="post" action="edit-block">
	<input type="text" name="name" placeholder="Name">
	<textarea name="css" placeholder="CSS"></textarea>
	<textarea name="code" placeholder="HTML"></textarea>
</form>

@stop