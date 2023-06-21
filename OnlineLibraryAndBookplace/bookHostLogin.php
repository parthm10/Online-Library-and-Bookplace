<!DOCTYPE html>
<?php
	include('connectDB.php');
	session_start();

	$error = "";	
	if(isset($_POST['loginbtn'])) {
		$bhmail = $_POST['bhmail'];
		$bhpass = $_POST['bhpass'];

        // Validating the entered email
        if (!filter_var($bhmail, FILTER_VALIDATE_EMAIL)) {
            $error = "<script> alert('Invalid Email Format!')</script>";
        }
		
		$sql = "SELECT * from bookhosts where bhmail='$bhmail' ";
		$result = mysqli_query($connect,$sql);
		$row    = mysqli_fetch_assoc($result);
		$count  = mysqli_num_rows($result);
		if($count==1) {
            // Verifying the Password using secure Hash
            if (password_verify($bhpass, $row['bhpass'])) {
                // Setting the Session Variables
                $_SESSION['bhid']   = $row['bhid'];
                $_SESSION['bhmail'] = $row['bhmail'];
                $_SESSION['bhname'] = $row['bhname'];
                header("location:bookHostDashboard.php");
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
    <title>Book Hosts Login</title>
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
            margin: auto;
        }
        .form{
            height: 420px;
            margin-top: 10px;
        }
        .navbar {
            font-family: Helvetica, sans-serif;
            position: fixed;
            top: 20px;
        }
        .submit {
            margin:30px auto 0px auto;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
	<div class="navbar" style="position:fixed; top:20px">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
	</div>

    <!-- BOOK HOST LOGIN FORM -->
    <form action="bookHostLogin.php" method="post">
        <div class="form">
            <center><div class="title" style="margin-top: 10px; font-size:2rem">Book Host Login</div></center>

            <div class="input-container ic2">
                <input name="bhmail" class="input" type="text" placeholder=" "  required />
                <div class="cut cut-short" style="width: 55px;"></div>
                <label for="bhmail" class="placeholder">Email</label>
            </div>

            <div class="input-container ic2">
                <input name="bhpass" class="input" type="password" placeholder=" " required />
                <div class="cut cut-short" style="width: 75px;"></div>
                <label for="bhpass" class="placeholder">Password</label><br>
            </div>

            <button type="submit" class="submit" value="Login" name='loginbtn'>Login</button>

            <div class="input-container ic2">
                <center style="font-family:Helvetica, sans-serif">
                    <a href="bookHostForm.php">Book Host Register</a><br><br>
                    <a href="userLogin.php">User Login</a><br>
                    <a href="librarianLogin.php">Librarian Login</a>
                </center>
            </div>
        </div>
    </form>
</body>
</html>