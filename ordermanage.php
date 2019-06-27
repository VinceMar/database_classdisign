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
			width: 15rem;
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
	<form method="POST" action="search.php" class="bs-example bs-example-form">
		<div class="input-group">
			<input type="text" name="keyword" class="form-control" placeholder="请输入您要搜索的订单">
			<input type="hidden" name="ordersearch" value="1">
			<button class="input-group-addon" type="submit">搜索</button>
		</div>
	</form>
	<h5>管理订单信息</h5>
	<?php
	require 'components/conn.php';
	$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
	$sql     = "SELECT * FROM tb_orderinfo";
	$results = $db->query($sql);
	while ($rows = $results->fetch_assoc()) {
		$s1 = '';
		$s2 = '';
		$s3 = '';
		switch ($rows['status']) {
			case 1:
				$s1 = 'selected';
				break;
			case 2:
				$s2 = 'selected';
				break;
			case 3:
				$s3 = 'selected';
				break;
		}
		$sql1    = "SELECT * FROM tb_bookinfo WHERE isbn=".$rows['isbn']."";
		$sql2    = "SELECT * FROM tb_userinfo WHERE id=".$rows['userid']."";
		$results1 = $db->query($sql1);
		$results2 = $db->query($sql2);
		$row = $results1->fetch_assoc();
		$row2 = $results2->fetch_assoc();
		$userdel = '否';
		if($rows['userdel']==0){
			$userdel = "是";
		}
		$paymethod = '货到付款';
		if($rows['paymethod']==1){
			$paymethod = '在线支付';
		}
		print<<<EOT
		<div class="card">
		<form method="post" action="admin/ordermanage.php">
		<div class="form-group">
				<p>订单号:{$rows['ordered']}</p>
			</div>
		<div class="form-group">
			<p>订单详情：</p>
			<p>书名：{$row['bookname']}</p>
			<p>订购用户名：{$row2['username']}</p>
			<p>订购用户电话：{$row2['telnum']}</p>
			<p>配送地址：{$rows['address']}</p>
			<p>支付方式：{$paymethod}</p>
		</div>
			<div class="form-group">
				<label>订单状态:</label>
				<select name="status">
				<option value="0" {$s1}>未完成</option>
				<option value="1" {$s2}>已完成</option>
				<option value="2" {$s3}>处理中</option>
				</select>
			</div>
			<div class="form-group">
			<p>用户是否删除：{$userdel}</p>
</div>
			<div class="form-group">
				<label for="">管理员是否删除:</label>
				<select name="del">
				<option value="1">否</option>
				<option value="0">是</option>
			</select>
			</div>
			<input type="hidden" name="ordered" value="{$rows['ordered']}">
			<button type="submit" class="btn btn-success btn-block">保存</button>
</form>
</div>	
EOT;
	}
	?>
</div>
</body>
</html>