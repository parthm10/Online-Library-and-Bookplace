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
    
    if($type == '1'){
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

    // Finding the ID of the Library
    else{
        if($isbn!='' && $title!="" && $libid!="" && $genre!="" && $author!="" && $qty!="" && $pubname!=""&& $pubyear!="" && $type!=""){
            $insert="INSERT INTO `books` (`isbn`, `title`, `genre`, `author`, `libid`, `quant`, `pub_name`, `pub_year`, `bookcover`, `type`) VALUES ('$isbn', '$title', '$genre', '$author', '$libid', '$qty', '$pubname', '$pubyear', '$cover', '$type')";
            $data=mysqli_query($connect,$insert);
            if($data) {
                echo "<script>alert('Successfully Updated!'); window.location.replace('librarianDashboard.php');</script>";
            }
            else {
                echo "<script>alert('Something went wrong!'); window.location.replace('librarianDashboard.php');</script>";
            }
        }
    }
?>