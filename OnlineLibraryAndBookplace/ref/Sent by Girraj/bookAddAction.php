<?php
    include("connectDB.php");

    $isbn=$title=$genre=$author=$author=$id=$qty=$pubname=$pubyear=$type="";
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $author = $_POST['author'];
    // $id = $_SESSION['libid'];
    $id = 500001;
    $qty = $_POST['quant'];
    $pubname = $_POST['pub_name'];
    $pubyear = $_POST['pub_year'];
    $cover = "https://covers.openlibrary.org/b/isbn/".$isbn."-L.jpg";
    $type = $_POST['type']; // Either Bookplace or a Library

    if($type == '1'){
        $type = "Bookplace";
    }
    else{
        $type = "Library";
    }

    // Checking if the book is already present or not
    $select = "SELECT isbn from books where isbn='$isbn'";
    $result = mysqli_query($conn,$select);
    if ($result->num_rows > 0){
        echo "<br>This book is already added!";
    }

    // Finding the ID of the Book Host or Library
    //

    else{
        if($isbn!='' && $title!="" && $id!="" && $genre!="" && $author!="" && $qty!="" && $pubname!=""&& $pubyear!="" && $type!=""){
            $insert="INSERT INTO `books` (`isbn`, `title`, `genre`, `author`, `libid`, `quant`, `pub_name`, `pub_year`, `bookcover`, `type`) VALUES ('$isbn', '$title', '$genre', '$author', '$id', '$qty', '$pubname', '$pubyear', '$cover', '$type')";
            $data=mysqli_query($conn,$insert);
            if($data) {
                $msg= "<br>Successfully Added";
            }
            else {
                $msg="<br>Something Went Wrong";
            }
            echo $msg;
        }
    }
?>