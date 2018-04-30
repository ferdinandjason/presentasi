<!DOCTYPE html>
<html>
<head>
	@include('semantic-ui.head')
	<title>@yield('title')</title>
	<style type="text/css">
		.card{
			margin: 10px !important;
		}

		.image img{
			object-fit: cover; /* Do not scale the image */
  			object-position: center; /* Center the image within the element */
  			height: 170px !important;
			width: 100% !important;
		}
	</style>
</head>
<body>
	@include('semantic-ui.navbar')
	@yield('content')
</body>
<script type="text/javascript">
	@yield('script')
</script>
</html>