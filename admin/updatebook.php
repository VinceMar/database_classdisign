<?php


class updatebook {
	private $isbn;
	private $bookname;
	private $category;
	private $isdel;

	public function __construct() {
		$this->isbn = $_POST['isbn'];
		$this->bookname = $_POST['bookname'];
		$this->category = $_POST['category'];
		$this->isdel = $_POST['del'];
	}

	public function doUpdateBook(){
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql = "UPDATE tb_bookinfo SET isbn = '$this->isbn' ,bookname = '$this->bookname' , category = '$this->category',`show` = '$this->isdel' WHERE isbn = '$this->isbn'";
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

$updatebook = new updatebook();
$updatebook->doUpdateBook();