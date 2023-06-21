<!DOCTYPE html>
<?php
	include("connectDB.php");

	// Checking if the User is logged in or not
	session_start();
	if(!isset($_SESSION['uname'])) {
        echo "<script> alert('Cannot Access this page! Please Login!'); window.location.replace('userLogin.php');</script>";
	}

	// Getting the Global Session variables for Users
	$uname = $_SESSION['uname'];
	$umail = $_SESSION['umail'];
?>


<html>
<head>
	<title>User Issued Books</title>
    <link rel="icon" href="images/AppIcon.png">
    <link rel="stylesheet" href="styles/userStyles.css">

	<!-- FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,600&display=swap" rel="stylesheet">
</head>

<body>
	<!-- NAVBAR -->
	<div class="navbar">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
		<a href="userDashboard.php" class="nav-items"">Home | </a>
		<a href="viewIssuedBook.php" class="nav-items">Issued Books | </a>
		<a href="userLogout.php" class="nav-items">Logout</a>
	</div>

    <!-- SALUTATION -->
	<center>
		<h2>Hello, <?php echo "<p style='color:blue; display: inline;'>$uname</p>"; ?>!</h2>
		<script>console.log('Login Successful')</script>
		<div style="background-color: #0E4F70; border-radius: 40px; width: 20%;">
			<h2 style="color: white;">Your Issued Books</h2>
		</div>
	</center>

    <!-- DISPLAYING ALL THE BOOKS CURRENTLY ISSUED BY THE USER -->
	<div>
      <table id="table1">
        <tr>
          <th style="width: 10%; margin: auto">Book Cover</th>
          <th>Title</th>
          <th>Author</th>
          <th>Genre</th>
          <th>Publication</th>
		  <th>Return</th>
          <th>Issue Date</th>
		  <th>Due Date</th>
        </tr>

        <?php
        // first getting isbn of books issued
        $hidden = 0;
        $getISBN = mysqli_query($connect, "SELECT * FROM `issued` WHERE umail = '$umail' AND return_date = 'na' ORDER BY issue_date ASC");
        while ($issuedBookISBN = mysqli_fetch_array($getISBN)){
            $dueDate = $issuedBookISBN['due_date'];
            $issueDate = $issuedBookISBN['issue_date'];
            $bookISBN = $issuedBookISBN['isbn'];
            
            $data = mysqli_query($connect, "SELECT * FROM `books` WHERE isbn='$bookISBN' ");
            while ($row = mysqli_fetch_array($data)) {
                $hidden = 1;
                echo "<tr>";
                $isbn       = $row["isbn"];
                $coverlink  = $row['bookcover'];
                $title      = $row["title"];
                $author     = $row['author'];
                $genre      = $row["genre"];
                $pub_name   = $row['pub_name'];

                $check = "<a href='returnBook.php?isbn=$bookISBN'>Return</a>";
                $image = "<img src='$coverlink' alt='Book Cover' style='height='100%'; width='100%';'>";
                echo "<td>";
                echo $image;
                echo "</td>";
                echo "<td>";
                echo $title;
                echo "</td>";

                echo "<td>";
                echo $author;
                echo "</td>";
                echo "<td>";
                echo $genre;
                echo "</td>";
                
                echo "<td>";
                echo $pub_name;
                echo "</td>";
                echo "<td>";
                echo $check;
                echo "</td>";

                echo "<td>";
                echo $issueDate;
                echo "</td>";
                echo "<td>";
                echo $dueDate;
                echo "</td>";

                echo "</tr>";
            }
        }
        if($hidden == 0){
            echo "<p>Currently you don't have any books issued!</p>";
            echo "<script>document.getElementById('table1').style.display = 'none';</script>";
        }
        ?>
      </table>
    </div>
</body>
</html>