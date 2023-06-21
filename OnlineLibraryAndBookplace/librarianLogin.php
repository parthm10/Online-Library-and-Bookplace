<!DOCTYPE html>
<?php
	include('connectDB.php');
	session_start();

	$error = "";
	if(isset($_POST['loginbtn'])) {
		$libmail = $_POST['libmail'];
		$libpass = $_POST['libpass'];
		
        // Validating the entered email
        if (!filter_var($libmail, FILTER_VALIDATE_EMAIL)) {
            $error = "<script> alert('Invalid Email Format!')</script>";
        }
		
		$sql = "SELECT * from library where libmail='$libmail' ";
		$result = mysqli_query($connect,$sql);
		$row    = mysqli_fetch_assoc($result);
		$count  = mysqli_num_rows($result);
		if($count==1) {
            // Verifying the Password using secure Hash
            if (password_verify($libpass, $row['libpass'])) {
                // Setting the Session Variables
                $_SESSION['libid']   = $row['libid'];
                $_SESSION['libmail'] = $row['libmail'];
                $_SESSION['libname'] = $row['libname'];
                header("location:librarianDashboard.php");
            }
            else{
                $error .= "<script> alert('Your Password is Invalid!') </script>";
            }
		}
		else {
			$error .= "<script> alert('Your Email is Invalid!')</script>";
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
    <title>Library Login</title>
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
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .form {
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

    <!-- LIBRARY LOGIN FORM -->
    <form action="librarianLogin.php" method="post">
        <div class="form">
            <center><div class="title">Library Login</div></center>

            <div class="input-container ic2">
                <input name="libmail" class="input" type="text" placeholder=" " pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" required />
                <div class="cut cut-short" style="width: 50px;"></div>
                <label for="libmail" class="placeholder">Email</label>
            </div>

            <div class="input-container ic2">
                <input name="libpass" class="input" type="password" placeholder=" " required />
                <div class="cut cut-short" style="width: 75px;"></div>
                <label for="libpass" class="placeholder">Password</label><br>
            </div>

            <button type="submit" class="submit" value="Login" name='loginbtn'>Login</button>

            <div class="input-container ic2">
                <center style="font-family:Helvetica, sans-serif">
                    <a href="librarianForm.php">Librarian Register</a><br><br>
                    <a href="userLogin.php">User Login</a><br>
                    <a href="bookHostLogin.php">Book Host Login</a
                </center>
            </div>
        </div>
    </form>
</body>
</html>