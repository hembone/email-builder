<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{{ $title }}</title>
</head>
<body>
	@include('includes.header')
	@yield('content')
	@include('includes.footer')
</body>
</html>