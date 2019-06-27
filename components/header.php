<?php
session_start();
$username = '';
if (isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container ">
		<a class="navbar-brand" href="index.php">裆裆网</a>
		<ul class="navbar-nav justify-content-end">
			<?php
			if ($username) {
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
					   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo $username; ?></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="./show.php">个人中心</a>
						<a class="dropdown-item" href="./editinfo.php">编辑资料</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="logout" href="#">
							<a href="./admin/logout.php" class="btn btn-block btn-danger" type="submit" name="button">退出</a>
						</a>
					</div>
				</li>
				<?php
			} else {
				?>
				<li class="nav-item"><a class="nav-link" href="./resign.php">注册</a></li>
				<li class="nav-item"><a class="nav-link" href="./login.php">登录</a></li>
				<?php
			}
			?>
		</ul>
	</div>
</nav>
