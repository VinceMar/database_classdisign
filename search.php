<?php
require 'components/conn.php';
$keyword = $_POST['keyword'];
$book='';
$order='';
if(isset($_POST['booksearch'])){
$book = $_POST['booksearch'];
}
if(isset($_POST['ordersearch'])){
$order = $_POST['ordersearch'];
}
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

		.return {
			margin-top: 10px;
			text-align: center;
		}
	</style>
</head>
<body>
<?php
require 'components/header.php';
?>
<div class="container">
	<p class="return"><a href="ordermanage.php" class="btn btn-primary return">返回</a></p>
	<?php
	if($book!='') {
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql     = "SELECT * from tb_bookinfo WHERE bookname LIKE '%$keyword%' OR bookinfo LIKE '%$keyword%' OR isbn LIKE '%$keyword%'";
		$results = $db->query($sql);
		while ($row = $results->fetch_assoc()) {
			print <<<EOT
	<div class="card">
			<img src="{$row['picurl']}" class="card-img-top" height="350px">
			<div class="card-body">
				<h5 class="card-title">《{$row['bookname']}》</h5>
				<small>作者：{$row['author']}</small>
				<p class="card-text">{$row['bookinfo']}</p>
				<button class="btn btn-primary btn-block">买tm的</button>
			</div>
		</div>
EOT;
		}
	}else{
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql     = "SELECT * from tb_orderinfo WHERE status LIKE '$keyword' OR userid LIKE '$keyword' ";
		$results = $db->query($sql);
		while ($row = $results->fetch_assoc()) {
			print <<<EOT
	<div class="card">
			<p>订单详情：</p>
			<p>订单编号：{$row['ordered']}</p>
			<p>订购用户编号：{$row['userid']}</p>
			<p>订购用户电话：{$row['telnum']}</p>
			<p>配送地址：{$row['address']}</p>
		</div>
EOT;
		}
	}
	?>
</div>
</body>
</html>
