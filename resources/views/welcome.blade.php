<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	{{ Vite::useBuildDirectory('app/front') }}
	<meta charset="utf-8">
	<meta name="viewport"
			content="width=device-width, initial-scale=1">
	<title>reka front test</title>
	@vite('resources/front/app.js')
</head>

<body>
	
	<div id="app"></div>
</body>

</html>