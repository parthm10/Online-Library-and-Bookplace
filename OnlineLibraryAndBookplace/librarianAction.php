<?php
    include('connectDB.php');

    $name=$mail=$pass=$id=$type=$pin=$addr="";
    $name = $_POST['lib_name'];
    $mail = $_POST['lib_mail'];
    $pass = $_POST['lib_pass'];
    $type = $_POST['lib_type'];
    $pin  = $_POST['lib_pin'];
    $addr = $_POST['lib_addr'];

    // Generating Hash to Store Passwords
    $secure_pass = password_hash($pass,PASSWORD_BCRYPT);

    $select = "select libmail from library where libmail='$mail'";
    $result = mysqli_query($connect,$select);
    // In order to check if the same mail exists or not!
    if ($result->num_rows > 0){
        echo "This mail is already used !! Try with different mail";
    }
    else{
        if($name!="" && $mail!="" && $pass!="" && $type!="" && $pin!="" && $addr!=""){
            $insert="INSERT INTO `library`(`libmail`,`libpass`,`libname`,`libtype`,`pincode`,`libaddr`) VALUES('".$mail."','".$secure_pass."','".$name."','".$type."','".$pin."','".$addr."')";
            $data=mysqli_query($connect, $insert);
            if($data) {
                $msg= "<script>alert('Successfully Registered'); window.location.replace('librarianLogin.php');</script>";
            }
            else{
                $msg="Something Went Wrong";
            }
        }
        else {
            $msg= "All fields are required";
        }
        echo $msg;
    }
?>