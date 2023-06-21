<?php
    include('connectDB.php');
    
    $bhname=$bhmail=$bhpass=$secure_pass=$id=$bhphone=$bhpinc=$bhaddr=$bhcity=$bhstate="";
    $bhname  = $_POST['bhname'];
    $bhmail  = $_POST['bhmail'];
    $bhpass  = $_POST['bhpass'];
    $bhphone = $_POST['bhphone'];
    $bhpinc  = $_POST['bhpinc'];
    $bhcity  = $_POST['bhcity'];
    $bhstate = $_POST['bhstate'];
    $bhaddr  = $_POST['bhaddr'];

    // Generating Hash to Store Passwords
    $secure_pass= password_hash($bhpass, PASSWORD_BCRYPT);

    $select = "select bhmail from bookhosts where bhmail='$bhmail'";
    $result = mysqli_query($connect,$select);
    // In order to check if the same mail exists or not!
    if ($result->num_rows > 0){
        echo "<script> alert('This email is already registered !! Try with different email'); window.location.replace('bookHostForm.php');</script>";
    }
    else {
        $insert="INSERT INTO `bookhosts`(`bhname`,`bhmail`,`bhpass`,`bhphone`,`bhpincode`,`bhcity`,`bhstate`, `bhaddr`) VALUES('$bhname', '$bhmail', '$secure_pass', '$bhphone', '$bhpinc', '$bhcity', '$bhstate', '$bhaddr')";
        $data=mysqli_query($connect,$insert);
        if($data) {
            echo "<script>alert('Successfully Registered'); window.location.replace('bookHostLogin.php');</script>";
        }
        else{
            $err = "Something Went Wrong! ".$connect->error;
            echo "<script>alert('$err');<script>";
        }
    }
?>