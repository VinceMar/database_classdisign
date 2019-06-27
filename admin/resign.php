<?php


class resign {
	private $username;
	private $password;

	public function __construct() {
		$this->username = $_POST['username'];
		$this->password = $_POST['password'];
	}

	public function doResign() {
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql    = "INSERT INTO tb_userinfo (username,password) VALUES ('$this->username','$this->password')";
		$result = $db->query($sql);
		if ($result) {
			echo "
            <script>
            alert('注册成功，请登录！');
            location.href = './../login.php';
</script>
            ";
			$db->close();
			exit();
		} else {
			echo $db->error;
			exit();
		}
	}
}

session_start();
$reg = new resign();
$reg->doResign();