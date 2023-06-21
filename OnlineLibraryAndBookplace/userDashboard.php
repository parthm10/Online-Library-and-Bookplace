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

<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- TITLE, APP ICON AND CSS -->
	<title>User Dashboard</title>
    <link rel="icon" href="images/AppIcon.png">
	<link rel="stylesheet" href="styles/userStyles.css?v=<?php echo time(); ?>">
	

	<!-- FONT -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;1,600&display=swap" rel="stylesheet">
	<style>
		input {
			border-radius	: 20px;
			font-family		: Helvetica, sans-serif;
			font-size		: 0.8rem;
			padding			: 5px;
		}
		select {
			border-radius	: 20px;
			font-family		: Helvetica, sans-serif;
			font-size		: 1rem;
			text-align		: center;
			padding			: 5px;
		}
	</style>
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
		<div style="background-color: #0E4F70; border-radius: 40px; width: 18%;">
			<h2 style="color: white;">Available Books</h2>
		</div>
	</center>
	
	<!-- CHOOSE THE BOOK SORT TYPE -->
	<form method="post">
		<center>
		<select name="sortBooks">
			<option value="sortByTitle">Sort by Book Title</option>
			<option value="sortByAuthor">Sort by Author Name</option>
			<option value="sortByGenre">Sort by Book Genre</option>
			<option value="sortbyPub">Sort by Book Publisher</option>
        </select>
		<input type="submit" name="sort" value="SORT">
		</center>
	</form>

	<?php
		$sortType = "";
		if(isset($_POST['sort'])){
			$sortType = $_POST['sortBooks'];
		}
	?>
	<br>
	<!-- DISPLAYING BOOKS AVAILABLE IN LIBRARY and BOOKPLACE -->
	<div id="tableBlur">

	
	<table>
		<tr>
		<th style="width: 10%; margin: auto">Book Cover</th>
		<th>Title</th>
		<th>Author</th>
		<th>Genre</th>
		<th>Publication</th>
		<th>Checkout</th>
		</tr>
		<div>
			<?php
			$data = "";
			if($sortType == 'sortByAuthor'){
				$data = mysqli_query($connect, "SELECT * FROM `books` ORDER BY author ASC");
			}
			else if($sortType == 'sortByGenre'){
				$data = mysqli_query($connect, "SELECT * FROM `books` ORDER BY genre ASC");
			}
			else if($sortType == 'sortByPub'){
				$data = mysqli_query($connect, "SELECT * FROM `books` ORDER BY pub_name ASC");
			}
			// Making Sort By Title as the Default Sorting Type
			else {
				$data = mysqli_query($connect, "SELECT * FROM `books` ORDER BY title ASC");
			}
			if($data){
				while ($row = mysqli_fetch_array($data)) {
					echo "<tr>";
					$isbn 		= $row["isbn"];
					$coverlink  = $row['bookcover'];
					$title 		= $row["title"];
					$author 	= $row['author'];
					$genre 		= $row["genre"];
					$pub_name 	= $row['pub_name'];
	
					$check = "<a href='viewBook.php?isbn=$isbn'>Issue</a>";
					$image = "<img src='$coverlink' alt='Book Cover' style='height='100%'; width='100%';'>";
	
					echo "<td style='width:'25%'; margin:'auto'; ' >"; 
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
					echo "</tr>";
				}
			}
			else{
				echo "<center>No Books are available currently!</center>";
			}
			?>
		</div>
	</table>
	</div>
	<br>
	<footer>
        <center>
            © SOFTWARE ENGINEERING, 2022. All Rights Reserved.
        </center>
    </footer>
</body>
</html>