<?php 
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['username'])){


?>
<!DOCTYPE html>
<html>
<head>
	<title>homepage</title>
</head>
<style type="">
	h1 {
		font-size: 60px;
	}
	a {
		font-size: 60px;
	}
</style>
<body>
	<h1 >Hello, <?php echo $_SESSION['name'];?></h1>
	<a href="login.php">Logout</a>
</body>
</html>
<?php
}else{
	header("Location: login.php");
	exit();
}
?>