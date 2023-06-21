<?php
    include('connectDB.php');

    // echo "<br>YES!";
    $name=$email=$pass=$spas=$id=$phone=$pin=$add=$city=$state="";
    $name  =$_POST['bhname'];
    $email = $_POST['bhmail'];
    $pass = $_POST['bhcpas'];
    $spas= password_hash($pass, PASSWORD_BCRYPT);
    // $id = $_POST['bhid'];
    $phone = $_POST['pno'];
    $pin = $_POST['bhpinc'];
    $city = $_POST['bhcity'];
    $state = $_POST['bhstate'];
    $add = $_POST['bhaddr'];

    $insert="INSERT INTO `bookhosts`(`bhname`,`bhmail`,`bhpass`,`bhphone`,`bhpincode`,`bhcity`,`bhstate`, `bhaddr`) VALUES('$name', '$email', '$spas', '$phone', '$pin', '$city', '$state', '$add')";
    $data=mysqli_query($conn,$insert);
    if($data) {
        echo "<br>Successfully Registered!";
    }
    else{
        echo "Something Went Wrong! ".$conn->error;
    }
?>