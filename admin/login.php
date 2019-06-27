<?php


class login {
	private $username;
	private $password;

	public function __construct() {
		$this->username = $_POST['username'];
		$this->password = $_POST['password'];
	}

	public function doLogin() {
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql    = "SELECT username FROM tb_userinfo WHERE username = '$this->username' AND password = '$this->password'";
		$result = mysqli_fetch_row($db->query($sql))[0];
		if (!$result) {
			echo "
                <script>
                    alert('用户名或密码错误');
                    history.go(-1);
                </script>
            ";
			exit();
		} else {
			$db->close();
			$_SESSION['username'] = $result;
			echo "<script>alert('登录成功!');location.href = './../index.php'</script>";
			exit();
		}
	}
}

session_start();
$login = new login();
$login->doLogin();