<?php
session_start();
$username = '';
if(isset($_SESSION['username'])){
	$username = $_SESSION['username'];
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
		h5 {
			margin-top: 25px;
		}
		.card {
			width: 20rem;
			display: inline-block;
			margin-top: 15px;
			margin-right: 15px;
			padding: 15px;
		}

		.card-text {
			margin-top: 10px;
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
	<?php
	$isbn = $_GET['isbn'];
	require 'components/conn.php';
	$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
	$sql = "SELECT * FROM tb_bookinfo WHERE isbn='$isbn'";
	$sql1 = "SELECT * FROM tb_userinfo WHERE username = '$username'";
	$results = $db->query($sql);
	$results2 = $db->query($sql1);
	$row = $results->fetch_assoc();
	$row2 = $results2->fetch_assoc();
	?>
	<h5>确认订单信息</h5>
	<div class="card">
		<img src="<?php echo $row['picurl']?>" class="card-img-top" height="350px">
	<p class="card-text">您所购买的书籍名称：<?php echo $row['bookname'] ?></p>
	<p class="card-text">您所购买的书籍ISBN：<?php echo $row['isbn'] ?></p>
		<p class="card-text">所需支付费用：<?php echo $row['bookprice2'] ?>元</p>
		<form method="post" action="admin/createorder.php">
			<div class="form-group">
				<label for="">您的联系方式为：</label>
				<input type="text" name="telnum" value="<?php echo $row2['telnum'] ?>">
			</div>
			<div class="form-group">
				<label for="">请输入您的配送地址：</label>
				<input type="text" name="address" value="">
			</div>
			<div class="form-group">
				<label for="">支付方式：</label>
				<select name="paymethod">
					<option value="0">货到付款</option>
					<option value="1">在线支付</option>
				</select>
			</div>
			<input type="hidden" name="orderdate" value="<?php echo date("Y-m-d H:i:s", time()+6*60*60) ?>">
			<input type="hidden" name="totalcost" value="<?php echo $row['bookprice2'] ?>">
			<input type="hidden" name="userid" value="<?php echo $row2['id'] ?>">
			<input type="hidden" name="isbn" value="<?php echo $row['isbn'] ?>">
			<button class="btn btn-danger" type="submit">确认订单</button>
		</form>
	</div>
</div>
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.js"></script>
</body>
</html>