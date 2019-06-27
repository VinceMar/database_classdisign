<?php


class addbook {
	private $bookname;
	private $isbn;
	private $category;
	private $bookprice1;
	private $bookprice2;
	private $bookinfo;
	private $publisher;
	private $publishdate;
	private $author;
	private $picurl;

	public function __construct() {
		$this->bookinfo = $_POST['bookinfo'];
		$this->bookname = $_POST['bookname'];
		$this->isbn = $_POST['isbn'];
		$this->category = $_POST['category'];
		$this->bookprice1 = $_POST['bookprice1'];
		$this->bookprice2 = $_POST['bookprice2'];
		$this->publisher = $_POST['publisher'];
		$this->publishdate = $_POST['publishdate'];
		$this->author = $_POST['author'];
		$this->picurl = $_POST['picurl'];
	}

	public function doAddBook(){
		require '../components/conn.php';
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
		$sql    = "INSERT INTO tb_bookinfo (isbn,bookname,category,bookprice1,bookprice2,bookinfo,publisher,publishdate,author) 
VALUES ('$this->isbn','$this->bookname','$this->category','$this->bookprice1','$this->bookprice2','$this->bookinfo','$this->publisher','$this->publishdate','$this->author')";
		$result = $db->query($sql);
		if ($result) {
			echo "
            <script>
            alert('添加成功！');
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

$addbook = new addbook();
$addbook->doAddBook();