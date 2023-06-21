<!DOCTYPE html>
<?php
	include('connectDB.php');
	session_start();
	// $connect = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
	$error=$emailErr="";
	
	if(isset($_POST['loginbtn']))
	{
		$myemail = $_POST['umail'];
		$mypassword = $_POST['upass'];
		$mypassword = md5($mypassword);
		
		if (empty($myemail)) { 	
			$emailErr = "Email is required"; $error++;
		}
		else {
			if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format"; $error++;
			}
		}
		
		
		$sql = "SELECT * from users where umail='$myemail' and upass='$mypassword' ";
		$result = mysqli_query($connect,$sql);
		
		$row = mysqli_fetch_assoc($result);
		
		$count = mysqli_num_rows($result);
		if($count==1) {
			$_SESSION['uname'] = $row['uname'];
			$_SESSION['umail'] = $row['umail'];
			header("location:userDashboard.php");
		}
		else {
			$error .= "Your Email or Password is invalid";
		}
		
	}
?>
<html>
<head>
	<link rel="icon" href="images/AppIcon.png">
	<title>User Login</title>
	
	<style>
		body {
			background-size:cover;
			background-color:#aee147;
		}
		
		.display-logo {
			margin-top:-8px;
			margin-left:42%;
			float:center;
			position: center;
		}
		
		.mainbox {
			background-color:#ffffff;
			margin-left:37%;
			margin-right:37%;
			margin-top:15px;
			border:1px solid #DDDDDD;
			padding:0px 25px;
			width:26%;
			height:65%;
			border-radius:10px;
		}
		
		.titlelogin {
			display:block;
			margin-top: 15px;
			margin-bottom: 10px;
			font-size: 25px;
			font-weight: bold;
			text-align:center;
			color:#0096FF;;
		}
		
		input[type="text"], input[type="password"]  {
			width: 100%;
			padding: 5px 10px;
			margin: 5px 0;
			display: inline-block;
			border: 1px solid #D9D9D9;
			box-sizing: border-box;
			border-radius:5px;
			font-family:Arial;
		}
		
		label {
			font-family:Arial;
			font-weight:550;
		}
		
		.login-button {
			width:100%;
			padding:5px 0px;
			text-align:center;
			background-color:#0096FF;
			border-color:#0086E5;
			border-radius:5px;
			color:white
		}
		.login-button:hover {
			background-color:#007ACE;
		}
		a {
			text-decoration:none;
		}
		a:hover {
			text-decoration:underline;
		}
		#loginstyle {
			text-align:center;
		}
		
		.container {
			margin-top:20px;
		}
		
		.txt1 {
			font-family: OpenSans-Regular;
			font-size: 15px;
			line-height: 1.4;
			color: #999999;
		}
		.txt2 {
			font-family: OpenSans-Regular;
			font-size: 15px;
			line-height: 1.4;
			color: #0096FF;
		}
		
		.bottom {
			display:block;
			text-align:center;
			padding-top:30px;
		}
	</style>
</head>

<body>
	<div class="mainbox">
		<span class="titlelogin">Login</span>
		<form action="userLogin.php" method="post">
			<div class="container">
				<label for="umail">Email or Phone Number</label>
				<input type="text" placeholder="Enter Email or Phone Number" name="umail" required>
				<span class = "error"><?php echo $emailErr;?></span><br><br>
				<label for="upass">Password</label>
				<input type="password" placeholder="Enter Password" name="upass" required><br>
				<label>
				<input type="checkbox" checked="checked" name="remember">Remember me<br>
				</label>
				<span style="color:red;font-size:15px;"><?php echo $error; ?></span>
				<br><br>
				<input type="submit" value="Login" name='loginbtn' class="login-button">	
			</div>
		</form>
		<div class="bottom">	
			<span class="txt1">Create an Account?</span>
			<a href="userForm.php" class="txt2">Sign up</a>
		</div>
	</div>
</body>
</html>