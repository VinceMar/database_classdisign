<?php
$bookname = $_POST['bookname'];
$reserve = $_POST['reserve'];
require '../components/conn.php';
$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
$sql = "UPDATE tb_bookinfo SET reserve='$reserve' WHERE bookname='$bookname'";
$result = $db->query($sql);
if($result){
	echo "
            <script>
            alert('修改库存成功！');
            location.href = '.././index.php';
</script>
            ";
	$db->close();
	exit();
}