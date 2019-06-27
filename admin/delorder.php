<?php
$ordered = $_GET['ordered'];
require '../components/conn.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "UPDATE tb_orderinfo SET userdel=0 WHERE ordered='$ordered'";
$result = $db->query($sql);
if($result){
	echo "
            <script>
            alert('删除订单成功！');
            location.href = '../index.php';
</script>
            ";
	exit();
	}