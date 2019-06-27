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
		.welcome,
		.intro {
			margin: 25px;
		}

		.card {
			padding: 15px;
			margin: 15px;
		}

		a.btn {
			margin: 15px;
		}
	</style>
</head>
<body>
<?php
require 'components/header.php';
require 'components/conn.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql    = "SELECT * from tb_userinfo WHERE username = '$username'";
$users  = $db->query($sql);
$rows   = $users->fetch_assoc();
$userid = $rows['id'];
?>
<div class="container">
	<h2 class="welcome">欢迎，<?php echo $rows['username'] ?></h2>
	<p class="intro">您是<?php
		if ($rows['isadmin'] == 2) {
			echo "系统管理员";
		} elseif ($rows['isadmin'] == 1) {
			echo "订单管理员";
		} elseif ($rows['isadmin'] == 0) {
			echo "会员";
		} else {
			echo "库存管理员";
		}
		?></p>
	<div class="row">
		<?php
		if ($rows['isadmin'] == 0) {
			$sql1    = "SELECT * FROM tb_orderinfo WHERE userid = '$userid' AND `show`=1 AND userdel=1";
			$results = $db->query($sql1);
			while ($row = $results->fetch_assoc()) {
				$staus = '';
				if ($row['status'] == 1) {
					$staus = "已完成";
				} elseif ($row['status'] == 2) {
					$staus = "订单处理中";
				} else {
					$staus = "未完成";
				}
				print <<<EOT
			<div class="card">
			<p>订单号：{$row['ordered']}</p>
			<p>书籍ISBN：{$row['isbn']}</p>
			<p>订单日期：{$row['orderdate']}</p>
			<p>订单费用：{$row['totalcost']}元</p>
			<p>状态：{$staus}</p>
			<a href="admin/delorder.php?ordered={$row['ordered']}" class="btn btn-danger btn-block">删除订单</a>
</div>
EOT;
			}
		} elseif ($rows['isadmin'] == 1) {
			$sqlsum    = "SELECT SUM(totalcost) FROM tb_orderinfo";
			$resultsum = $db->query($sqlsum);
			$money     = $resultsum->fetch_assoc();
			print <<<EOT
			<a href="ordermanage.php" class="btn btn-info">订单管理</a>
			<p>总销售额：{$money['SUM(totalcost)']}元</p>
EOT;
		} elseif ($rows['isadmin'] == 2) {
			print <<<EOT
			<a href="usersmanage.php" class="btn btn-primary">用户管理</a>
			<a href="booksmanage.php" class="btn btn-primary">图书管理</a>
EOT;
		} else {
			print <<<EOT
			<a href="reservemanager.php" class="btn btn-primary">库存管理</a>
EOT;
		}
		?>
	</div>
</div>
<script src="https://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.js"></script>
</body>
</html>