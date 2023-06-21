<?php
$conn = mysqli_connect("localhost","root","","online_library_bookplace");

$name=$mail=$pass=$id=$type=$pin=$addr="";
$name = $_POST['lib_name'];
$mail = $_POST['lib_mail'];
$pass = $_POST['lib_pass'];
$id = $_POST['lib_id'];
$type = $_POST['lib_type'];
$pin = $_POST['lib_pin'];
$addr = $_POST['lib_addr'];

$secure_pass=password_hash($pass,PASSWORD_BCRYPT);

$select = "select libmail from library where libmail='$mail'";
$result = mysqli_query($conn,$select);

if ($result->num_rows > 0){
    echo "This mail is already used !! Try with different mail";
}
else{
if($name!="" && $mail!="" && $pass!="" && $id!="" && $type!="" && $pin!="" && $addr!=""){
    $insert="INSERT INTO `library`(`libmail`,`libpass`,`libid`,`libname`,`libtype`,`pincode`,`libaddr`) VALUES('".$mail."','".$secure_pass."','".$id."','".$name."','".$type."','".$pin."','".$addr."')";
    $data=mysqli_query($conn,$insert);
    if($data){
        $msg= "Successfully Added";
	}
    else{
        $msg="Something Went Wrong";
    }
}
else
{
	$msg= "All field are required";
}
echo $msg;
}
?>