<?php

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
<body>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<img src="https://images.shobserver.com/news/690_390/2017/4/21/de6c603f-1899-4eee-b722-a4e8ed1aabe9.jpg"
			     width="100%" height="100%">
		</div>
		<div class="col-md-4">
			<div class="card ">
				<div class="card-header">
					<h5>登录</h5>
				</div>
				<div class="card-body">
					<form method="POST" action="admin/login.php">
						<div class="form-group">
							<label for="username">用户名：</label>
							<input type="text" name="username" class="form-control">
						</div>
						<div class="form-group">
							<label for="password">密码：</label>
							<input type="password" name="password" class="form-control">
						</div>
						<button type="submit" class="btn btn-primary">登录</button>
					</form>
				</div>
</body>
</html>
