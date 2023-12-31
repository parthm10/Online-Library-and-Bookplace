<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>User Registration</title>
	<link rel="icon" href="images/AppIcon.png">
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
			margin-bottom:20px;
			width:26%;
			height:600px;
			border-radius:10px;
		}
		
		.titlelogin {
			display:block;
			margin-top: 15px;
			margin-bottom: 10px;
			font-size: 28px;
			font-weight: bold;
			text-align:center;
			color:#0096FF;;
		}
		
		input[type="text"], input[type="password"]  {
			width: 100%;
			padding: 5px 10px;
			margin: 5px 0 15px 0;
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
		
		.error {
			color:red;
			font-size:15px;
		}
	</style>
</head>

<?php
	include('connectDB.php');
	session_start();	
	$nameErr = $emailErr = $pswErr =  "";
	$error = 0;
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$myuname = mysqli_real_escape_string($connect,$_POST['uname']);
		$myemail = mysqli_real_escape_string($connect,$_POST['umail']);
		$mypsw = mysqli_real_escape_string($connect,$_POST['upass']);
		
		if (empty($myuname)) {
			$nameErr = "Name is required!"; $error++;
		}
		if (empty($myemail)) { 	
			$emailErr = "Email is required!"; $error++;
		}
		else {
			if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
                  $emailErr = "Invalid email format"; $error++;
			}
		}
		if (empty($mypsw)) { 
			$pswErr= "Password is required"; $error++;
		}
		
		$sql = "SELECT * FROM users WHERE umail='$myemail' ";
		$result = mysqli_query($connect, $sql);
		$user = mysqli_fetch_assoc($result);
		  
		if ($user) {
			if ($user['umail'] === $myemail) {
			  $emailErr = "Email already exists"; $error++;
			}
		}
		// Finally, register user if there are no errors in the form
		if ($error == 0) {
			$psw = md5($mypsw); //encrypt the password before saving in the database

			$query = "INSERT INTO users (uname,umail,upass) VALUES('$myuname', '$myemail', '$psw')";
			echo $query;
			if (mysqli_query($connect, $sql)) {
				echo "Values inserted successfully";
			} else {
				echo "Error creating table: " .mysqli_error($conn);
			}
			mysqli_query($connect, $query);
			$_SESSION['uname'] = $myuname;
			$_SESSION['success'] = "You are now logged in";
			$_SESSION['umail'] = $myemail;
			header('location:userLogin.php');
		}
	}
?>

<body>
	<div class="mainbox">
		<span class="titlelogin">User Registration</span>
		<form action="userForm.php" method="post">
			<div class="container">
			
				<label for="uname">Username</label>
				<input type="text" placeholder="Enter Username" name="uname">
				<span class = "error"><?php echo $nameErr;?></span><br>

				<label for="umail">Email</label>
				<input type="text" placeholder="Enter Email" name="umail">
				<span class = "error"><?php echo $emailErr;?></span><br>
				
				<label for="upass">Password</label>
				<input type="password" placeholder="Enter Password" name="upass">
				<span class = "error"><?php echo $pswErr;?></span><br><br>
				<button type="submit" class="login-button">Register</button>		
			</div>
		</form>
		
		<div class="bottom">
			<span class="txt1">Already have an Account?</span>
			<a href="userLogin.php" class="txt2">Log In</a>
		</div>
	</div>
</body>
</html>