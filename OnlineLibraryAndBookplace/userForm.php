<!DOCTYPE html>
<?php
	include('connectDB.php');
	session_start();

	$error =  "";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$myuname = mysqli_real_escape_string($connect, $_POST['uname']);
		$myemail = mysqli_real_escape_string($connect, $_POST['umail']);
		$mypass  = mysqli_real_escape_string($connect, $_POST['upass']);
		
		// Checking if the user already exists or not
		$sql = "SELECT * FROM users WHERE umail='$myemail' ";
		$result = mysqli_query($connect, $sql);
		$user = mysqli_fetch_assoc($result);
		if ($user) {
			if ($user['umail'] === $myemail) {
			  $error = "<script> alert('Email Already Exists!')</script>";
			}
		}
	
		// Registering User 
		if($error === "") {
			$psw = md5($mypass); // Hashing the password before saving in the database
			$query = "INSERT INTO users (uname,umail,upass) VALUES('$myuname', '$myemail', '$psw')";
			$result = mysqli_query($connect, $query);
			if ($result) {
				$error = "<script> console.log('User Registered Successfully!') </script>";
				echo $error;
				// Setting the Global Session Variables
				$_SESSION['uname'] = $myuname;
				$_SESSION['umail'] = $myemail;
				header('location:userDashboard.php');
			}
			else {
				$error = "<script> alert('An Error Occured!') </script>";
				echo $error;
				header('location:userForm.php');
			}
		}
		echo $error;
	}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- TITLE, APP ICON AND CSS -->
    <title>User Registration</title>
    <link rel="icon" href="images/AppIcon.png">
    <link rel="stylesheet" href="styles/authStyles.css">
    
	<style>
		a {
            text-decoration: none;
            color: lightgray;
        }
        a:visited {
            color: lightgray;
        }
        a:hover {
            color: white;
        }
        body{
            background-image: url('images/bg.jpg');
        }
        .form{
            height: 430px;
        }
		.navbar {
            font-family: Helvetica, sans-serif;
            position: fixed;
            top: 20px;
        }
		.title {
            margin-top: 0px;
        }
    </style>
</head>

<body>
    <!-- HEADER / NAVBAR-->
	<div class="navbar" style="position:fixed; top:30px">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
	</div>
    <form action="userForm.php" method="post">
        <div class="form">
			<div class="input-container ic1" style="margin-top: 0px; margin-bottom: -30px;">
                <center><div class="title" style="color: white; font-size:1.6rem;">User Registration</div></center>
            </div>

            <div class="input-container ic2">
                <input name="uname" class="input" type="text" placeholder=" " required />
                <div class="cut cut-short" style="width: 80px;"></div>
                <label for="uname" class="placeholder">Username</label>
            </div>

            <div class="input-container ic2">
                <input name="umail" class="input" type="text" placeholder=" " pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" required />
                <div class="cut cut-short" style="width: 55px;"></div>
                <label for="umail" class="placeholder">Email</label>
                <p id="em_err">Invalid Email</p>
            </div>

            <div class="input-container ic2">
                <input name="upass" class="input" type="password" placeholder=" " required />
                <div class="cut cut-short" style="width: 75px;"></div>
                <label for="upass" class="placeholder">Password</label>
            </div>

            <button type="submit" class="submit">Register</button>

			<div class="input-container ic2">
                <center style="font-family:Helvetica, sans-serif">
                    <p style="display:inline-block; color:lightblue; margin-top:0px;">Already Registered?</p>
                    <a href="userLogin.php" style="margin-top:0px;">User Login</a><br><br>
                </center>
            </div>
        </div>
    </form>
</body>
</html>