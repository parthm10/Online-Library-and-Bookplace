<!DOCTYPE html>
<?php
    include("connectDB.php");

    // Checking if the Book Host is logged in or not
    session_start();
    if(!isset($_SESSION['bhid'])) {
        echo "<script> alert('Cannot Access this page! Please Login!'); window.location.replace('bookHostLogin.php'); </script>";
    }

    // Setting the Global Session variables for Book Host
    $bhid   = $_SESSION["bhid"];
    $bhmail = $_SESSION["bhmail"];
    $bhname = $_SESSION["bhname"];

    // Taking the ISBN of the Book using GET request
    $isbn  = $_GET['isbn'];

    // Getting the Information on Books
    $query = "select * from books where `books`.`isbn`= '$isbn'";
    $query1 = mysqli_query($connect, $query);
    $title=$author=$quantity=$type=$genre=$coverlink=$pubname=$pubyear="";  
    if($query1){
        $bookDetails = mysqli_fetch_array($query1);
        $title      = $bookDetails['title'];
        $author     = $bookDetails['author'];
        $quantity   = $bookDetails['quant'];
        $type       = $bookDetails['type'];
        $genre      = $bookDetails['genre'];
        $coverlink  = $bookDetails['bookcover'];
        $pubname    = $bookDetails['pub_name'];
        $pubyear    = $bookDetails['pub_year'];
    }

    // Getting the Information of Book Host
    $bhquery = "select * from bookhosts where `bookhosts`.`bhid`= '$bhid'";
    $bhquery1 = mysqli_query($connect, $bhquery);
    $bhDetails = mysqli_fetch_array($bhquery1);
    $bhname = $bhDetails['bhname'];
    $bhaddr = $bhDetails['bhaddr'];
    $bhpinc = $bhDetails['bhpincode'];

    if ($quantity > 0) {
        // Removing Book
        if (isset($_POST['remove'])) {

            // Checking if the book is issued.
            $ifIssued = "SELECT umail FROM issued WHERE isbn = '$isbn'";
            $ifIssued1 = mysqli_query($connect, $ifIssued);
            $ifIssued3 = 0; // Flag for this condition
            if($ifIssued1){
                $ifIssued2 = mysqli_fetch_array($ifIssued1);
                if(!$ifIssued2[3] == $bhid){
                    $ifIssued3 = 1;
                    echo "<script>alert('This book is currently issued! So, it cannot be deleted'); window.location.replace('bookHostDashboard.php');</script>";
                }
                else{
                    // If not issued, then removing the book
                    $sql = "DELETE FROM `books` WHERE isbn='$isbn' AND libid='$bhid' ";
                    $sql1 = mysqli_query($connect, $sql);
                    if($sql1){
                        echo "<script>alert('The book has been deleted!'); window.location.replace('bookHostDashboard.php');</script>";
                    }
                    else{
                        echo "<script>alert('An error occured while removing book!'); window.location.replace('bookHostDashboard.php');</script>";
                    }
                }
            }
        }
    }
    else {
        echo "<script>alert('Sorry! All Books have been issued right now! Hence, book cannot be removed'); window.location.replace('bookHostDashboard.php');</script>";
    }
?>

<html>

<head>
    <title>Book Details</title>
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
		<a href="bookHostDashboard.php" class="nav-items"">Home | </a>
		<a href="bookAddBH.php" class="nav-items">Add Book | </a>
		<a href="bookHostLogout.php" class="nav-items">Logout</a>
	</div>

    <!-- SALUTATION -->
    <center>
        <h2>Hello, <?php echo "<p style='color:blue; display: inline;'>$bhname</p>"; ?>!</h2>
        <h2>Book Information Page</h2>
    </center>

    <!-- BOOK INFORMATION -->
    <div>
        <table id="bookInfo" style="margin:10px">
            <tr>
                <td>Book Title</td>
                <td><?php echo $title;?></td>
                <td rowspan="8" style="width: 25%;">
                    <center>
                        <?php echo "<img src='$coverlink' alt='Book Cover' style='height='100%'; width='100%';'>"; ?>
                    </center>
                </td>
            </tr>
            <tr>
                <td>ISBN</td>
                <td><?php echo $isbn; ?></td>
            </tr>
            <tr>
                <td>Author</td>
                <td><?php echo $author; ?></td>
            </tr>
            <tr>
                <td>Genre</td>
                <td><?php echo $genre;?></td>
            </tr>
            <tr>
                <td>Publication</td>
                <td><?php echo $pubname; ?></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><?php echo $pubyear;?></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><?php echo $quantity;?> Books</td>
            </tr>
            <tr>
                <td>Available at </td>
                <td><?php echo "$bhname ($type), $bhaddr, Pincode: $bhpinc"; ?></td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="2">
                    <form method="post">
                        <!-- <center><input type="submit" value="Remove The Book" name="remove"></center> -->
                        <center><button type="submit" name="remove">Remove The Book</button></center>
                    </form>
                </td>
            </tr>
            <!-- <tr>
                <form method="post" action="bookUpdateBH.php">
                    <td colspan="2">
                        <input type="hidden" name="isbn" value=<?php echo $isbn;?> >
                        <center><input type="submit" value="Update Book Details" name="update"></center>
                    </td>
                </form>
            </tr> -->
        </table>
        
    </div>

    <!-- FOOTER -->
    <!-- <div style="color: grey; width:100%; height:40px; margin-bottom:0%">
        <center>
        <h4> © BATCH 01, Software Engineering. 2022</h4>
        </center>
    </div> -->
</body>
</html>