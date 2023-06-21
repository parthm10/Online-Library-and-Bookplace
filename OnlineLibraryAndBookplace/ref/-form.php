<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian</title>
    <style>
    </style>
</head>
<body>
    
    <form method="post" action="form.php">
    <table>
        <tr>
        <td><label for="lib_name">Name</label></td>
        <td><input type="text" name="lib_name"></td>
        </tr>
        <tr>
        <td><label for="lib_pass">Password</label></td>
        <td><input type="password" name="lib_pass"></td>
        </tr>
        <tr>
            <td><label for="lib_id">Library ID</label></td>
            <td><input type="text" name="lib_id"></td>
        </tr>
        <tr>
            <td><label for="lib_mail">Mail</label></td>
            <td><input type="text" name="lib_mail"></td>
        </tr>
        <tr>
            <td><label for="lib_type">Type</label></td>
            <td><input type="text" name="lib_type"></td>
        </tr>
        <tr>
            <td><label for="lib_pin">Pincode</label></td>
            <td><input type="text" name="lib_pin"></td>
        </tr>
        <tr>
            <td><label for="lib_addr">Address</label></td>
            <td><input type="text" name="lib_addr"></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="submit">
            </td>
        </tr>
    </table>
    </form>
</body>

<?php
    $conn = mysqli_connect("localhost", "root", "", "online_library_bookplace");
    if(isset($_POST['submit'])){
        $name=$mail=$pass=$id=$type=$pin=$addr="";
        $name = $_POST['lib_name'];
        $mail = $_POST['lib_mail'];
        $pass = $_POST['lib_pass'];
        $id = $_POST['lib_id'];
        $type = $_POST['lib_type'];
        $pin = $_POST['lib_pin'];
        $addr = $_POST['lib_addr'];
        unset($_POST);
        $secure_pass=password_hash($pass, PASSWORD_BCRYPT);

        $select = "select libmail from library where libmail='$mail'";
        $result = mysqli_query($conn,$select);

        if ($result->num_rows > 0){
            echo "<script>alert('This mail is already used !! Try with different mail')</script>";
        }
        else{
            if($name!="" && $mail!="" && $pass!="" && $id!="" && $type!="" && $pin!="" && $addr!=""){
                $insert="INSERT INTO `library`(`libmail`,`libpass`,`libid`,`libname`,`libtype`,`pincode`,`libaddr`) VALUES('".$mail."','".$secure_pass."','".$id."','".$name."','".$type."','".$pin."','".$addr."')";
                $data=mysqli_query($conn,$insert);
                if($data){
                    $msg= "<script>alert('Successfully Added')</script>";
                }
                else{
                    $msg="<script>alert('Something Went Wrong')</script>";
                }
            }
            else{
                $msg= "<script>alert('All field are required')</script>";
            }
            echo $msg;
        }
    }
    
?>
</html>