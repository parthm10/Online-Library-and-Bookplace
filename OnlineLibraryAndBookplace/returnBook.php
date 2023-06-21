<!DOCTYPE html>
<?php
	include("connectDB.php");

	session_start();
	$uname = $_SESSION["uname"];
	$umail = $_SESSION["umail"];

	// To get selected book info
	$isbn = $_GET["isbn"];

    // Getting Book Details from Books table
    $query = "select * from books where `books`.`isbn`= '$isbn'";
    $query1 = mysqli_query($connect, $query);
    $bookDetails = mysqli_fetch_array($query1);
    $quantity = $bookDetails['quant'];


    // Getting Current Time
    $sql1 = "select date_format(curdate(),'%d-%m-%Y')";
    $res1 = mysqli_query($connect, $sql1);
    $row1 = mysqli_fetch_row($res1);
    $returnDate = $row1[0];

    // delete from issued
    $sql = "DELETE FROM `issued` WHERE isbn = '$isbn' ";
    // $sql = "UPDATE `student_book` SET" . "`book_2_id` ='$id'," . "`book_2` = '$book_name'," . "`recive_date_2` = '$recive'," . "`submisson_date_2` = '$due'" . " WHERE `student_book`.`emailid` =" . "'$email'";
    $data = mysqli_query($connect, $sql);
    if ($data){
        // Increase Quantity of that book in Lib or Bookplace
        $cur = $quantity + 1;
        $sql2 = "UPDATE `books` SET" . "`quant` ='$cur'" . " WHERE `books`.`isbn` =" . "'$isbn'";
        mysqli_query($connect, $sql2);
        echo "<script>alert('Book Returned!'); window.location.replace('viewIssuedBook.php');</script>";
    }
    else {
        $msg = "Something went wrong!";
    }
?>