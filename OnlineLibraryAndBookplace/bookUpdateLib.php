<!DOCTYPE html>
<?php
    include("connectDB.php");
    
    // Checking if the Librarian is logged in or not
    session_start();
    if(!isset($_SESSION['libid'])) {
        echo "<script> alert('Cannot Access this page! Please Login!'); window.location.replace('librarianLogin.php');</script>";
    }

    // Setting the Global Session variables for Librarian
    $libid   = $_SESSION["libid"];
    $libmail = $_SESSION["libmail"];
    $libname = $_SESSION["libname"];

    // Taking the ISBN of the Book using POST request sent via Update Book button
    $isbn  = $_POST['isbn'];

    // Getting the initial values of the fields of Books Table
    // In order to prefill the form with current book info
    if (!isset($_POST['updateBookInfo'])){
        $query = "select * from books where `books`.`isbn`= '$isbn'";
        $query1 = mysqli_query($connect, $query);
        $bookDetails = mysqli_fetch_array($query1);

        $isbn       = $bookDetails['isbn'];
        $title      = $bookDetails['title'];
        $author     = $bookDetails['author'];
        $quantity   = $bookDetails['quant'];
        $type       = $bookDetails['type'];
        $genre      = $bookDetails['genre'];
        $coverlink  = $bookDetails['bookcover'];
        $pubname    = $bookDetails['pub_name'];
        $pubyear    = $bookDetails['pub_year'];
    }
    
    // Updating the Book information in books table
    if (isset($_POST['updateBookInfo'])) {
        // ISBN cannot be changed
        $title1     = $_POST['title'];
        $author1    = $_POST['author'];
        $quantity1  = $_POST['quant'];
        $genre1     = $_POST['genre'];
        $pubname1   = $_POST['pub_name'];
        $pubyear1   = $_POST['pub_year'];
        
        $sql = "UPDATE books SET title='$title1', genre='$genre1', author='$author1', quant='$quantity1', pub_name='$pubname1', pub_year='$pubyear1' WHERE isbn='$isbn' ;";
        $sql1 = mysqli_query($connect, $sql);
        if($sql1){
            echo "<script>alert('Successfully Updated!'); window.location.replace('librarianDashboard.php');</script>";
        }
        else{
            echo "<script>alert('Error Occurred!');</script>";
        }
    }
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE, APP ICON AND CSS -->
    <title>Book Update</title>
    <link rel="icon" href="images/AppIcon.png">
    <!-- <link rel="stylesheet" href="styles/userStyles.css"> -->
	<link rel="stylesheet" href="styles/userStyles.css?v=<?php echo time(); ?>">

	<!-- FONT -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,600&display=swap" rel="stylesheet">

    <style>
        div form{
            font-size: 1.25rem;
        }
        table{
            margin: auto;
        }
    </style>
</head>

<body>
    <!-- HEADER / NAVBAR-->
	<div class="navbar">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
		<a href="librarianDashboard.php" class="nav-items"">Home | </a>
		<a href="bookAddLib.php" class="nav-items">Add Book | </a>
		<a href="librarianLogout.php" class="nav-items">Logout</a>
	</div>

	<!-- SALUTATION -->
	<center>
        <h2><?php echo "<p style='color:blue; display: inline;'>$libname</p>"; ?></h2>
        <h2>Update Book</h2>
    </center>

    <!-- BOOK UPDATE FORM -->
    <table style="width: 70%;">
        <form method="post" name="myForm" onsubmit="validateForm()">
            <tr>
                <td><label for="isbn">ISBN</label></td>
                <td><?php echo "$isbn"; ?><input type="hidden" name="isbn" value="<?php echo "$isbn"; ?>"></td>
                <td rowspan="8" style="width: 25%;">
                    <center>
                        <?php echo "<img src='$coverlink' alt='Book Cover' style='height='100%'; width='100%';'>"; ?>
                    </center>
                </td>
            </tr>
            <tr>
                <td><label for="title">Title</label></td>
                <td><input type="text" name="title" value="<?php echo "$title"; ?>"></td>
            </tr>
            <tr>
                <td><label for="genre">Genre</label></td>
                <td>
                <select name="genre">
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
                </td>
            </tr>
            <tr>
                <td><label for="pub_name">Publication Name</label></td>
                <td><input type="text" name="pub_name" value="<?php echo $pubname; ?>" ></td>
            </tr>
            <tr>
                <td><label for="quant">Quantity</label></td>
                <td><input type="number" name="quant" value="<?php echo "$quantity"; ?>" ></td>
            </tr>
            <tr>
                <td><label for="author">Author</label></td>
                <td><input type="text" name="author" value="<?php echo $author; ?>"></td>
            </tr>
            <tr>
                <td><label for="pub_year">Publication Year</label></td>
                <td><input type="number" name="pub_year" value="<?php echo "$pubyear"; ?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <!-- <center><input type="submit" value="Update Book Info" name="updateBookInfo"></center> -->
                    <center><button type="submit" name="updateBookInfo">Update Book Info</button></center>
                </td>
            </tr>
        </form>
    </table>
    
    <!-- FORM VALIDATION -->
    <script type="text/javascript">
        function validateForm() {
            if (document.myForm.title.value == "") {
                alert("Please enter a Title for the Book!");
                document.myForm.title.focus();
                return false;
            }

            if (document.myForm.genre.value == "") {
                alert("Please choose the Genre for the Book!!");
                document.myForm.genre.focus();
                return false;
            }

            if (document.myForm.pub_name.value == "") {
                alert("Please enter the name of the Publisher!");
                document.myForm.pub_name.focus();
                return false;
            }

            if (document.myForm.quant.value == "") {
                alert("Please specify the number of available copies of the book!");
                document.myForm.quant.focus();
                return false;
            }

            if (document.myForm.author.value == "") {
                alert("Please provide the name(s) of the Author(s) of the Book!");
                document.myForm.author.focus();
                return false;
            }

            if (document.myForm.pub_year.value == "") {
                alert("Please enter the Publication Year of the Book!");
                return false;
            }
            else {
                let x = document.myForm.pub_year.value;
                let y = parseInt(x);
                console.log(y)
                console.log(typeof(y))
                if (y < 1967) {
                    alert("Publication Year should be after 1967!");
                }
                document.myForm.pub_year.focus();
                return false;
            }
            document.myForm.submit();
            return (true);
        }
    </script>
</body>
</html>