<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>
{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'); }}
{{ HTML::style('assets/css/main.css'); }}
@yield('styles')
</head>
<body>
	@include('includes.header')
	@yield('content')
	@include('includes.footer')
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'); }}
{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'); }}
{{ HTML::script('assets/js/main.js'); }}
@yield('scripts')
</body>
</html>