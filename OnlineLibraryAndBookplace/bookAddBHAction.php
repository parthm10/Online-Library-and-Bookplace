<?php
    include("connectDB.php");

    // Checking if the Book Host is logged in or not
	session_start();
    if(!isset($_SESSION['bhid'])) {
        echo "<script> alert('Cannot Access this page! Please Login!'); window.location.replace('bookHostLogin.php');</script>";
    }

    // Getting the Global Session variables for Book Host
    $bhid	= $_SESSION["bhid"];
	$bhmail = $_SESSION["bhmail"];
    $bhname = $_SESSION["bhname"];

    $isbn=$title=$genre=$author=$genre=$author=$qty=$pubname=$pubyear=$type="";
    $isbn    = $_POST['isbn'];
    $title   = $_POST['title'];
    $genre   = $_POST['genre'];
    $author  = $_POST['author'];
    $qty     = $_POST['quant'];
    $pubname = $_POST['pub_name'];
    $pubyear = $_POST['pub_year'];
    $type    = $_POST['type']; // Either Bookplace or a Library
    $cover   = "https://covers.openlibrary.org/b/isbn/".$isbn."-L.jpg";

    if($type == '0'){
        $type = "Bookplace";
    }
    else{
        $type = "Library";
    }

    // Checking if the book is already present or not
    $select = "select isbn from books where isbn='$isbn'";
    $result = mysqli_query($connect,$select);
    if ($result->num_rows > 0){
        echo "<br>This book is already added!";
    }

    // Finding the ID of the Book Host
    else{
        if($isbn!='' && $title!="" && $bhid!="" && $genre!="" && $author!="" && $qty!="" && $pubname!=""&& $pubyear!="" && $type!=""){
            $insert="INSERT INTO `books` (`isbn`, `title`, `genre`, `author`, `libid`, `quant`, `pub_name`, `pub_year`, `bookcover`, `type`) VALUES ('$isbn', '$title', '$genre', '$author', '$bhid', '$qty', '$pubname', '$pubyear', '$cover', '$type')";
            $data=mysqli_query($connect,$insert);
            if($data) {
                echo "<script>alert('Successfully Updated!'); window.location.replace('bookHostDashboard.php');</script>";
            }
            else {
                echo "<script>alert('Something Went Wrong!'); window.location.replace('bookHostDashboard.php');</script>";
            }
        }
    }
?>