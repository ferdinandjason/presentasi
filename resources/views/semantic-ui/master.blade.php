<!DOCTYPE html>
<html>
<head>
	@include('semantic-ui.head')
	<title>@yield('title')</title>
	@yield('css')
</head>
<body>
	@include('semantic-ui.navbar')
	@yield('content')
	@include('semantic-ui.footer')
</body>
<script type="text/javascript">
	@yield('script')
</script>
</html>