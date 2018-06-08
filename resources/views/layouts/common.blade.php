<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
		<link rel="stylesheet" href="/css/app.css">
		<script src="/js/jquery-3.2.1.min.js"></script>
	</head>
	<body>
		<header>
			<h1 class="col-sm-8"><a href="/">TOrip DOrist</a></h1>
		</header>
			@yield('content')
	</body>
</html>