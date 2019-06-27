<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>裆裆网</title>
	<link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
	<style>
		.card {
			width: 20rem;
			display: inline-block;
			margin-top: 15px;
			margin-right: 15px;
			padding: 15px;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container ">
		<a class="navbar-brand" href="index.php">裆裆网</a>
	</div>
</nav>
<div class="container">
	<h5>当前库存：</h5>
	<?php
	require 'components/conn.php';
	$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
	$sql = "SELECT * FROM tb_bookinfo";
	$results = $db->query($sql);
	while ($rows = $results->fetch_assoc()) {
		print<<<EOT
		<div class="card">
		<form method="post" action="admin/addrestore.php">
			<div class="form-group">
			<p>书名：<input type="text" name="bookname" value="{$rows['bookname']}" readonly></p>
			<p>当前库存：<input type="text" name="reserve" value="{$rows['reserve']}"></p>
</div>
			<button type="submit" class="btn btn-success btn-block">保存</button>
</form>
</div>	
EOT;
	}
	?>
</div>
</body>
</html>