<?php
session_start();
unset($_SESSION['username']);
echo "<script>alert('您已登出!');
location.href = './../index.php';
</script>";
exit();