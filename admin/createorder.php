<?php


class createorder {
	private $telnum;
	private $address;
	private $orderdate;
	private $totalcost;
	private $userid;
	private $isbn;
	private $paymethod;

	public function __construct() {
		$this->telnum = $_POST['telnum'];
		$this->address = $_POST['address'];
		$this->orderdate = $_POST['orderdate'];
		$this->totalcost = $_POST['totalcost'];
		$this->userid = $_POST['userid'];
		$this->isbn = $_POST['isbn'];
		$this->paymethod = $_POST['paymethod'];
	}

	public function doCreateOrder(){
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql = "INSERT INTO tb_orderinfo (orderdate,totalcost,userid,isbn,address,telnum,paymethod) 
VALUES ('$this->orderdate','$this->totalcost','$this->userid','$this->isbn','$this->address','$this->telnum','$this->paymethod')";
		$sqlbookreserve = "SELECT reserve FROM tb_bookinfo WHERE isbn='$this->isbn'";
		$resultbookreserve = $db->query($sqlbookreserve);
		$rows = $resultbookreserve->fetch_assoc();
		$reserve = --$rows['reserve'];
		$sqlupdatereserve = "UPDATE tb_bookinfo SET reserve='$reserve' WHERE isbn='$this->isbn'";
		$result2 = $db->query($sqlupdatereserve);
		$result = $db->query($sql);
		if ($result&&$result2) {
			echo "
            <script>
            alert('订单创建成功！');
            location.href = '../index.php';
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

$createorder = new createorder();
$createorder->doCreateOrder();