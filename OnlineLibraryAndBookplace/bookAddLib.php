<!DOCTYPE html>
<?php
	include("connectDB.php");
    
    // Checking if the Librarian is logged in or not
    session_start();
    if(!isset($_SESSION['libid'])) {
        echo "<script> alert('Cannot Access this page! Please Login!'); window.location.replace('librarianLogin.php'); </script>";
    }

    // Setting the Global Session variables for Librarian
    $libid   = $_SESSION["libid"];
    $libmail = $_SESSION["libmail"];
    $libname = $_SESSION["libname"];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE, APP ICON AND CSS -->
    <title>Add a Book</title>
    <link rel="icon" href="images/AppIcon.png">
    <link rel="stylesheet" href="styles/authStyles.css">

    <style>
        body{
            background-image: url('images/bg.jpg');
            margin: auto;
        }
        .form{
            height: 380px;
            margin-top: 0px;
        }
        #formPart1{
            border-bottom-right-radius: 0px;
            border-top-right-radius: 0px;
        }
        #formPart2{
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
        }
        footer {
            font-family: Helvetica, sans-serif;
            position: fixed;
            bottom: 20px;
        }
        .navbar {
            font-family: Helvetica, sans-serif;
            position: fixed;
            top: 20px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
	<div class="navbar">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
	</div>

    <table>
    <form method="post" action="bookAddLibAction.php" name="myForm" onsubmit="validateForm()">   
        <div class="form" id="formPart1">
            <div class="input-container ic1" style="margin-top: -30px; margin-bottom: -30px;">
                <div class="title" style="color: white; font-size:1.5rem;">Add Book to Library</div>
            </div>
                
            <div class="input-container ic2">
                <input id="isbn" class="input" type="number" placeholder=" " required name="isbn"/>
                <div class="cut cut-short" style="width: 55px;"></div>
                <label for="isbn" class="placeholder">ISBN</label>
            </div>

            <div class="input-container ic2">
                <input id="title" class="input" type="text" placeholder=" " required name="title"/>
                <div class="cut cut-short" style="width: 50px;"></div>
                <label for="title" class="placeholder">Title</label>
            </div>

            <div class="input-container ic2">
                <select name="genre" class="input" name="genre">
                    <option value="Action">Action</option>
                    <option value="Biography">Biography</option>
                    <option value="Comic">Comic</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Fiction">Fiction</option>
                    <option value="History">History</option>
                    <option value="Horror">Horror</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Romance">Romance</option>
                    <option value="Science">Science</option>
                    <option value="Self-Improvement">Self-Improvement</option>
                    <option value="Textbook">Textbook</option>
                    <option value="Thriller">Thriller</option>
                </select>
                <div class="cut cut-short" style="width: 70px;"></div>
                <label for="genre" class="placeholder">Genre</label>
            </div>

            <div class="input-container ic2">
                <input id="pub_name" class="input" type="text" placeholder=" " required name="pub_name"/>
                <div class="cut cut-short" style="width: 120px;"></div>
                <label for="pub_name" class="placeholder">Publication Name</label>
            </div>
        </div>

        <div class="form" id="formPart2">
            <div class="input-container ic1" style="margin-top: -30px; margin-bottom: -30px;">
                <div class="title" style="color: white; font-size:1.5rem;""></div>
            </div>

            <div class="input-container ic2">
                <input id="quant" class="input" type="number" placeholder=" " required name="quant"/>
                <div class="cut cut-short" style="width: 70px;"></div>
                <label for="quant" class="placeholder">Quantity</label>
            </div>

            <div class="input-container ic2">
                <input id="author" class="input" type="text" placeholder=" " required name="author"/>
                <div class="cut cut-short" style="width: 60px;"></div>
                <label for="author" class="placeholder">Author</label>
            </div>

            <div class="input-container ic2">
                <input id="pub_year" class="input" type="number" placeholder=" " required name="pub_year"/>
                <div class="cut cut-short" style="width:110px;"></div>
                <label for="pub_year" class="placeholder">Publication Year</label>
            </div>

            <input type="hidden" name="type" value="0">
            
            <button type="text" class="submit" style="margin-top: 30px;">Add Book</button>
        </div>
    </form>
    </table>

    <footer>
        <center>
            © BATCH 01 SOFTWARE ENGINEERING
        </center>
    </footer>
</body>
</html>