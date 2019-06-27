<?php


class updateadmin {
	private $adminname;
	private $adminjob;

	public function __construct() {
		$this->adminname = $_POST['adminname'];
		$this->adminjob = $_POST['adminjob'];
	}

	public function doUpdateAll() {
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql = "UPDATE tb_userinfo SET username = '$this->adminname' ,isadmin = '$this->adminjob' WHERE username = '$this->adminname'";
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

$updateall = new updateadmin();
$updateall->doUpdateAll();