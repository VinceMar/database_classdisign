<?php
	include 'components/conn.php'
?>
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
		}

		.card .card-text {
			display: -webkit-box;
			-webkit-box-orient: vertical;
			-webkit-line-clamp: 3;
			overflow: hidden;
		}

		form {
			margin-top: 20px;
			width: 250px;
		}
	</style>
</head>
<body>
<?php require 'components/header.php' ?>
<div class="container">
	<form method="POST" action="search.php" class="bs-example bs-example-form">
		<div class="input-group">
			<input type="text" name="keyword" class="form-control" placeholder="请输入您要搜索的内容...">
			<input type="hidden" name="booksearch" value="1">
			<button class="input-group-addon" type="submit">搜索</button>
		</div>
	</form>
	<?php
	$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
	$sql   = "SELECT * from tb_bookinfo WHERE `show`=1";
	$books = $db->query($sql);
	while ($row = $books->fetch_assoc()) {
		print <<<EOT
		<div class="card">
			<img src="{$row['picurl']}" class="card-img-top" height="350px">
			<div class="card-body">
				<h5 class="card-title">《{$row['bookname']}》</h5>
				<small>作者：{$row['author']}&nbsp;&nbsp;出版社：{$row['publisher']}</small>
				<p class="card-text">{$row['bookinfo']}</p>
				<h5>市场价：<s>{$row['bookprice1']}￥</s>&nbsp;&nbsp;&nbsp;会员价：{$row['bookprice2']}￥</h5>
				<a href="createorder.php?isbn={$row['isbn']}" class="btn btn-primary btn-block">立即购买</a>
			</div>
		</div>
EOT;
	}
	?>
</div>
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.js"></script>
</body>
</html>
