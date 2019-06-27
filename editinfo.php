<?php
session_start();
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
	<title>裆裆网</title>
	<link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
</head>
<style>
	form {
		margin-top: 20px;
	}
</style>
<body>
<?php
require 'components/conn.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql    = "SELECT * FROM tb_userinfo WHERE username = '$username'";
$result = $db->query($sql);
$rows = $result->fetch_assoc();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container ">
		<a class="navbar-brand" href="index.php">裆裆网</a>
	</div>
</nav>
<div class="container">
	<form method="post" action="admin/update.php">
		<div class="form-group">
			<label for="">用户名：</label>
			<input type="text" class="form-control" name="username" value="<?php echo $rows['username']?>">
		</div>
		<div class="form-group">
			<label for="">密码：</label>
			<input type="password" class="form-control" name="password" value="<?php echo $rows['password']?>">
		</div>
		<div class="form-group">
			<label for="">电话：</label>
			<input type="tel" class="form-control" name="telnum" value="<?php echo $rows['telnum']?>">
		</div>
		<button type="submit" class="btn btn-success btn-block">保存</button>
	</form>
</div>
</body>
</html>
