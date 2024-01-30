<?php
	/*include_once("connection.php");

	$con = connection();

	$sql = "SELECT * FROM user";
	$db = $con->query($sql) or die ($con->error);
	$row = $db->fetch_assoc();


if(!isset($_SESSION)){ */
	session_start(); 

	include_once("connection.php");

	$con = connection();
/*
	if(isset($_POST['submit'])){

		$surname = $_POST['username'];
		$password = $_POST['password'];

	$sql = "SELECT * FROM user WHERE username = '$surname' AND password = '$password'";
	$db = $con->query($sql) or die ($con->error);
	$row = $db->fetch_assoc();

	$total = $db->num_rows;

		if($total > 0){
		echo header("Location: homepage.php");
		}else{

			return;
		}
	}*/
	
	if(isset($_POST['username']) && isset($_POST['password'])){
		function validate($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$username = validate($_POST['username']);
		$password = validate($_POST['password']);

		if(empty($username)){
			header("Location: login.php?error=User Name is Required");
			exit();
		}else if(empty($password)){
			header("Location: login.php?error=User Password is Required");
			exit();
		}else{
			$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
			$result = mysqli_query($con, $sql);

			if(mysqli_num_rows($result) === 1){
				$row = mysqli_fetch_assoc($result);

				if($row['username'] === $username && $row['password'] === $password){
					$_SESSION['username'] = $row['username'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					header("Location: homepage.php");
					exit();
				}
			}else{
				header("Location: login.php?error=Incorrect password or username");
				exit();
			}
		}

	}
?>

<html>
<head>
	<title>Log In</title>
	

	<link rel="icon" type="image/x-icon" href="pic/Logo.png">	

</head>
<style type="">
	
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: "Poppins", sans-serif;
	}
	body {
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;

		background: url('pic/bg.png') no-repeat;
		background-size: cover;
		background-position: center;
	}
	.wrapper {
		width: 750px;
		height: 700px;
		background: linear-gradient(to right, rgba(0, 0, 255, 0.6), rgba(255, 255, 255, 0.9));
		box-shadow: 0 0 10px rgba(0, 0, 0, -2);
		color: #fff;
		border-radius: 70px;
		padding: 30px 40px;
	
	}

	.wrapper form {
		margin-top: -590px;
		opacity: 99%;
	}
	#logo {
		width: 600px;
		height: 600px; 
		margin-top: 30px;
		margin-left: 30px;
		opacity: 30%;

	}
	.wrapper .input-box {
		position: relative;
		width: 100%;
		height: 110px;
		margin: 30px 0;
	}
	.input-box input {
		width: 100%;
		height: 100%;
		background: transparent;
		border: 6px solid white;
		outline: none;
		font-weight: 600;
		border-radius: 60px;
		font-size: 32px;
		color: white;
		padding: 20px 45px 20px 20px;
	}
	.input-box input::placeholder {
		color: white;
	}

	.input-box i {
		position: absolute;
		right: 20px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 100px;
	}
	.wrapper .remember-forgot {
		display: flex;
		justify-content: space-between;
		font-size: 25px;
		margin: -15px 0 15px;
		float: right;
	}
	.remember-forgot label input {
		accent-color: #fff;
		margin-right: 3px;
		
	}
	.remember-forgot a {
		color: blue;
		font-weight: 600;
		text-decoration: none;

	}
	.remember-forgot a:hover {
		text-decoration: underline;
	}
	.wrapper .btn {
		width: 100%;
		height: 100px;
		background: blue	;
		border: none;
		outline: none;
		border-radius: 40px;
		box-shadow: 0 0 10px rgba(0, 0, 0, -1);
		cursor: pointer;
		font-size: 35px;
		color: white;
		font-weight: 600;
	}
	.wrapper .register-link {
		font-size: 25px;
		text-align: center;
		margin: 20px 0 15px;
		color: blue;
		font-weight: 600;
	}
	.register-link p a {
		color: blue;
		text-decoration: none;
		font-weight: 900;
	}
	.register-link p a:hover {
		text-decoration: underline;
	}
	.error {
		background: white;
		color: red;
		padding: 10px;
		width: 100%;
		border-radius: 15px;
		font-size: 25px;
		opacity: 90%;
		justify-content: center;
		align-items: center;
	}
	input[type="checkbox"] {
		width: 20px;
		height: 20px;
	}
	
</style>
<body>
	
	<div class="wrapper">
		<img src="pic/AULOGO.png" id="logo">
		<form action="" method="post">
			<?php if(isset($_GET['error'])){?>
				<p class="error"><?php echo $_GET['error'];?></p>
			<?php } ?></br>
			<div class="input-box">
				<input type="text" placeholder="Username" name="username" >
				<i class="fa-solid fa-user"></i>
			</div>
			<div class="input-box">
				<input type="password" placeholder="Password" class="password" name="password" >
				<i class="fa-solid fa-eye" id="eye"></i>
			</div></br>
			<div class="remember-forgot">
				<!--<label><input type="checkbox"> Remember Me</label>-->
				<a href="forgotpass.php">Forgot password?</a>
			</div></br></br>
			<button type="submit" class="btn" name="submit">Log In</button></br></br>
			<div class="register-link">
				<p>Dont have an account? <a href="register.php">Register Here</a></p>
			</div>

		</form>
	</div>
<script type="">
	const  passwordInput = document.querySelector(".password");
	const eyeIcon = document.querySelector("#eye");	

	eyeIcon.addEventListener("click", () => {

		passwordInput.type = passwordInput.type === "password" ? "text" : "password";

		eyeIcon.className = `fa-solid fa-eye${passwordInput.type === "password" ? "" : "-slash"}`;
	});
</script>
</html>