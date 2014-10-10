<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{{ $title }}</title>
{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'); }}
{{ HTML::style('assets/css/main.css'); }}
</head>
<body>
	@include('includes.header')
	@yield('content')
	@include('includes.footer')
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); }}
{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'); }}
{{ HTML::script('assets/js/main.js'); }}
</body>
</html>