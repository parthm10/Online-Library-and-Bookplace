<!DOCTYPE html>
<?php
	include('connectDB.php');
	session_start();

    // Checking if the user is already logged in or not
    if(isset($_SESSION['umail'])) {
        header("location:userDashboard.php");
        // echo "<script> alert('Cannot Access this page! Please Login!'); window.location.replace('librarianLogin.php');</script>";
    }
	$error = "";
	if(isset($_POST['loginbtn'])) {
		$myemail    = $_POST['umail'];
		$mypassword = $_POST['upass'];
		$mypassword = md5($mypassword);

        // Validating the entered email
		if (empty($myemail)) { 	
			$error = "<script> alert('Email is Required!')</script>";
		}
		else {
			if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
                $error = "<script> alert('Invalid Email Format!')</script>";
			}
		}
		
		$sql = "SELECT * from users where umail='$myemail' and upass='$mypassword' ";
		$result = mysqli_query($connect,$sql);
		$row = mysqli_fetch_assoc($result);
		$count = mysqli_num_rows($result);
		if($count==1) {
            // Setting the Global Session variables for User
			$_SESSION['uname'] = $row['uname'];
			$_SESSION['umail'] = $row['umail'];
			header("location:userDashboard.php");
		}
		else {
			$error .= "<script> alert('Your Email or Password is Invalid!')</script>";
            
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
    <title>User Login</title>
    <link rel="icon" href="images/AppIcon.png">
    <link rel="stylesheet" href="styles/authStyles.css">

    <style>
        a {
            text-decoration: none;
            color: whitesmoke;
        }
        a:visited {
            color: whitesmoke;
        }
        a:hover {
            color: white;
        }
        body{
            background-image: url('images/bg.jpg');
            margin-top: 0px;
            margin-bottom: 0px;
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
    <!-- HEADER -->
	<div class="navbar">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
	</div>

    <!-- USER LOGIN FORM -->
    <form action="userLogin.php" method="post">
        <div class="form">
            <center><div class="title">User Login</div></center>

            <div class="input-container ic2">
                <input name="umail" class="input" type="text" placeholder=" " pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" required />
                <div class="cut cut-short" style="width: 50px;"></div>
                <label for="umail" class="placeholder">Email</label>
            </div>

            <div class="input-container ic2">
                <input name="upass" class="input" type="password" placeholder=" " required />
                <div class="cut cut-short" style="width: 75px;"></div>
                <label for="upass" class="placeholder">Password</label><br>
            </div> 

            <button type="submit" class="submit" value="Login" name='loginbtn'>Login</button>

            <div class="input-container ic2">
                <center style="font-family:Helvetica, sans-serif">
                    <a href="userForm.php">User Register</a><br><br>
                    <a href="librarianLogin.php">Librarian Login</a><br>
                    <a href="bookHostLogin.php">Book Host Login</a>
                </center>
            </div>
        </div>
    </form>
</body>
</html>