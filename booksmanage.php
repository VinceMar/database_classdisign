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
		form {
			margin-top: 20px;
		}
		.card {
			padding: 15px;
			width: 20rem;
			display: inline-block;
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
	<form method="post" action="admin/addbook.php">
		<h5>添加图书</h5>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">书名：</label>
						<input type="text" class="form-control" name="bookname" value="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">ISBN：</label>
						<input type="text" class="form-control" name="isbn" value="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">类别：</label>
						<input type="text" class="form-control" name="category" value="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">市场价：</label>
						<input type="text" class="form-control" name="bookprice1" value="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">会员价：</label>
						<input type="text" class="form-control" name="bookprice2" value="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">简介：</label>
						<input type="text" class="form-control" name="bookinfo" value="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">出版社：</label>
						<input type="text" class="form-control" name="publisher" value="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">出版日期：</label>
						<input type="date" class="form-control" name="publishdate" value="">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">作者：</label>
						<input type="text" class="form-control" name="author" value="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">图书图片地址：</label>
						<input type="url" class="form-control" name="picurl" value="">
					</div>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">提交</button>
	</form>

	<h5>管理图书信息</h5>
	<?php
	require 'components/conn.php';
	$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
	$sql   = "SELECT * from tb_bookinfo";
	$books = $db->query($sql);
	while ($row = $books->fetch_assoc()) {
		print <<<EOT
	<div class="card">
	<form method="post" action="admin/updatebook.php">
			<div class="form-group">
				<label for="">ISBN:</label>
				<input type="text" class="form-control" name="isbn" value="{$row['isbn']}">
			</div>
			<div class="form-group">
				<label for="">书名:</label>
				<input type="text" class="form-control" name="bookname" value="{$row['bookname']}">
			</div>
			<div class="form-group">
				<label for="">分类:</label>
				<input type="text" class="form-control" name="category" value="{$row['category']}">
			</div>
			<div class="form-group">
				<label for="">是否删除:</label>
				<select name="del">
				<option value="1">否</option>
				<option value="0">是</option>
			</select>
			</div>
		<button type="submit" class="btn btn-primary">提交</button>
	</form>
</div>
EOT;

	}
	?>


</div>
</body>
</html>