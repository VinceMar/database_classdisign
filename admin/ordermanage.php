<?php


class ordermanage {
private $status;
private $del;
private $ordered;

public function __construct() {
	$this->status = $_POST['status'];
	$this->del = $_POST['del'];
	$this->ordered = $_POST['ordered'];
}

public function doUpdateOrder(){
	require '../components/conn.php';
	$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
	$sql = "UPDATE tb_orderinfo SET status = '$this->status' ,`show` = '$this->del' WHERE ordered = '$this->ordered'";
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

$ordermanage = new ordermanage();
$ordermanage->doUpdateOrder();