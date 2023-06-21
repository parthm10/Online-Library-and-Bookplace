<!DOCTYPE html>
<?php
    include("connectDB.php");
    $msg = "";
    session_start();
    
    $uname = $_SESSION["uname"];
    $umail = $_SESSION["umail"];

    $isbn  = $_GET['isbn'];

    $query = "select * from books where `books`.`isbn`= '$isbn'";
    $query1 = mysqli_query($connect, $query);
    $bookDetails = mysqli_fetch_array($query1);

    $title = $bookDetails['title'];
    $author = $bookDetails['author'];
    $quantity = $bookDetails['quant'];
    $type = $bookDetails['type'];
    $genre = $bookDetails['genre'];
    $libid = $bookDetails['libid'];
    $coverlink = $bookDetails['bookcover'];
    $pubname = $bookDetails['pub_name'];
    $pubyear = $bookDetails['pub_year'];

    if($type == "Bookplace"){
        $bquery = "select * from bookhosts where `bookhosts`.`bhid`= '$libid'";
        $bquery1 = mysqli_query($connect, $bquery);
        $bDetails = mysqli_fetch_array($bquery1);
        $libname = $bDetails['bhname'];
        $libaddr = $bDetails['bhaddr'];
        $libpinc = $bDetails['bhpincode'];
    }
    else{
        $libquery = "select * from library where `library`.`libid`= '$libid'";
        $libquery1 = mysqli_query($connect, $libquery);
        $libDetails = mysqli_fetch_array($libquery1);
        $libname = $libDetails['libname'];
        $libaddr = $libDetails['libaddr'];
        $libpinc = $libDetails['pincode'];
    }
    

    if ($quantity > 0) {
        // Issuing Book
        if (isset($_POST['rqst'])) {
            
            // Checking if the book is already issued or not
            $ifIssued = "SELECT umail FROM issued WHERE isbn = '$isbn'";
            $ifIssued1 = mysqli_query($connect, $ifIssued);
            $ifIssued3 = 0; // Flag for this condition
            if($ifIssued1){
                $ifIssued2 = mysqli_fetch_array($ifIssued1);
                if($ifIssued2[0] == $umail){
                    $msg = "<br>You have already issued this Book!<br>";
                    $ifIssued3 = 1;
                    echo "<script>alert('You have already issued this Book!'); window.location.replace('userDashboard.php');</script>";
                }
            }

            // Finding the no. of Books the student already has. If greater than 4 then can't take more.
            $qNoBooks = "SELECT COUNT(umail) FROM issued WHERE umail = '$umail' AND return_date = 'na'";
            $qNoBooks1 = mysqli_query($connect, $qNoBooks);
            if($qNoBooks1 && $ifIssued3 == 0){
                $countBooks = mysqli_fetch_array($qNoBooks1);
                if($countBooks['COUNT(umail)'] < 5){
                    $i = $countBooks['COUNT(umail)'];
                    echo "<script>console.log('No. of Books')</script>";
                    echo "<script>console.log($i)</script>";
                    $sql1 = "select date_format(curdate(),'%d-%m-%Y')";
                    $res1 = mysqli_query($connect, $sql1);
                    $row1 = mysqli_fetch_row($res1);
                    $issued = $row1[0];

                    $sql2 = "select date_format(curdate()+15,'%d-%m-%Y')";
                    $res2 = mysqli_query($connect, $sql2);
                    $row2 = mysqli_fetch_row($res2);
                    $due = $row2[0];
                    
                    // Inserting into issued table
                    $sql = "INSERT INTO `issued` (`umail`, `isbn`, `libid`, `issue_date`, `due_date`, `return_date`) VALUES ('$umail', '$isbn', '$libid', '$issued', '$due', 'na')";
                    // $sql = "UPDATE `student_book` SET" . "`book_2_id` ='$id'," . "`book_2` = '$book_name'," . "`recive_date_2` = '$recive'," . "`submisson_date_2` = '$due'" . " WHERE `student_book`.`emailid` =" . "'$email'";
                    $data = mysqli_query($connect, $sql);

                    if ($data) {
                        // Decreasing the quantity of the book available
                        $cur = $quantity - 1;
                        $sql3 = "UPDATE `books` SET" . "`quant` ='$cur'" . " WHERE `books`.`isbn` =" . "'$isbn'";
                        mysqli_query($connect, $sql3);
                        echo "<script>alert('Book Issued!'); window.location.replace('userDashboard.php');</script>";
                    }
                    else {
                        $msg = "Something went wrong!";
                    }
                }
                else {
                    $msg = "You cannot have more than 4 books issued at the same time";
                }
            }
        }
    }
    else {
        $msg = "Sorry! Book is not available at the moment!";
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
		<a href="userDashboard.php" class="nav-items"">Home | </a>
		<a href="viewIssuedBook.php" class="nav-items">Issued Books | </a>
		<a href="userLogout.php" class="nav-items">Logout</a>
	</div>

    <!-- SALUTATION -->
    <h3>Hello,
	<?php
		// In order to check if user is already logged in or not
		if(!isset($_SESSION['uname'])) {
			echo "<script> alert('Cannot Access this page! Please Login!') </script>";
			header("Location: userLogin.php");
		}
		$username = $_SESSION['uname'];
		echo "<p style='color:blue; display: inline;'>$username</p>"; // To print the name
	?></h3>
    <center><h2>Book Information Page</h2></center>
    <div>
        <form method="post">
            <table id="bookInfo">
                <tr>
                    <td>Book Title</td>
                    <td><?php echo $title;?></td>
                    <td rowspan="7" style="width: 15%;">
                        <center>
                            <?php
                                $image = "<img src='$coverlink' alt='Book Cover' style='height='100%'; width='100%';'>";
                                echo $image;
                            ?>
                        </center>
                    </td>
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
                    <td>Available at </td>
                    <td><?php echo "$libname ($type), $libaddr, Pincode: $libpinc"; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- <center><input type="submit" value="Issue The Book" name="rqst"></center> -->
                        <center><button type="submit" name="rqst">Issue the Book</button></center>
                    </td>
                    <!-- <td style="color:red;font-weight:bold;text-align:center;"></td> -->
                </tr>
                <?php echo $msg; ?>
            </table>
        </form>
    </div>

    <!-- FOOTER -->
    <!-- <div style="color: grey; width:100%; height:40px; margin-bottom:0%">
        <center>
        <h4> © BATCH 01, Software Engineering. 2022</h4>
        </center>
    </div> -->
</body>
</html>