<?php
session_start();
require 'components/conn.php';
$username = '';
if (isset($_SESSION['username'])) {
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
	<link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
	<title>裆裆网</title>
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
<?php
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql     = "SELECT * from tb_userinfo WHERE username = '$username'";
$results = $db->query($sql);
$rows    = $results->fetch_assoc();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container ">
		<a class="navbar-brand" href="index.php">裆裆网</a>
	</div>
</nav>
<div class="container">
	<?php
	if ($rows['isadmin'] == 2) {
		$sql1     = "SELECT * FROM tb_userinfo WHERE isadmin = 1";
		$adminers = $db->query($sql1);
		while ($rows = $adminers->fetch_assoc()) {
			print<<<EOT
		<div class="card">
		<form method="POST" action="admin/updateadmin.php">
		<div class="form-group">
			<label for="">管理员姓名：</label>
			<input type="text" class="form-control" name="adminname" value="{$rows['username']}" readonly>
		</div>
		<div class="form-group">
			<label for="">管理员权限：</label>
			<select name="adminjob">
				<option value="2">系统管理员</option>
				<option value="1">普通管理员</option>
				<option value="0">用户</option>
			</select>
		</div>
			<button type="submit" class="btn btn-success btn-block">保存</button>
</form>
		</div>

EOT;
		}
			$sql2  = "SELECT * FROM tb_userinfo WHERE isadmin = 0";
			$users = $db->query($sql2);
			while ($rows = $users->fetch_assoc()) {
				print<<<EOT
			<div class="card">
					<form method="POST" action="admin/update.php">
		<div class="form-group">
			<label for="">用户名：</label>
			<input type="text" class="form-control" name="username" value="{$rows['username']}" readonly>
		</div>
		<div class="form-group">
			<label for="">密码：</label>
			<input type="password" class="form-control" name="password" value="{$rows['password']}">
		</div>
		<div class="form-group">
			<label for="">电话：</label>
			<input type="tel" class="form-control" name="telnum" value="{$rows['telnum']}">
		</div>
		<button type="submit" class="btn btn-success btn-block">保存</button>
	</form>
			</div>
EOT;
			}

	} else {
		$sql2  = "SELECT * FROM tb_userinfo WHERE isadmin = 0";
		$users = $db->query($sql2);
		while ($rows = $users->fetch_assoc()) {
			print<<<EOT
			<div class="card">
				<form method="post" action="admin/update.php">
		<div class="form-group">
			<label for="">用户名：</label>
			<input type="text" class="form-control" name="username" value="{$rows['username']}">
		</div>
		<div class="form-group">
			<label for="">密码：</label>
			<input type="password" class="form-control" name="password" value="{$rows['password']}">
		</div>
		<div class="form-group">
			<label for="">电话：</label>
			<input type="tel" class="form-control" name="telnum" value="{$rows['telnum']}">
		</div>
		<button type="submit" class="btn btn-success btn-block">保存</button>
	</form>
			</div>
EOT;
		}
	}
	?>
	</form>
</div>
</body>
</html>