<?php


class update {
	private $username;
	private $telnum;
	private $password;

	public function __construct() {
		$this->username = $_POST['username'];
		$this->telnum = $_POST['telnum'];
		$this->password = $_POST['password'];
	}

	public function doUpdate(){
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql = "UPDATE tb_userinfo SET username = '$this->username' ,password = '$this->password' , telnum = '$this->telnum' WHERE username = '$this->username'";
		$result = $db->query($sql);
		if($result){
			echo "
            <script>
            alert('更改成功！');
            location.href = '../index.php';
</script>
            ";
			$db->close();
			exit();
		}else{
			echo $db->error;
			exit();
		}
	}
}

session_start();
$update = new update();
$update->doUpdate();