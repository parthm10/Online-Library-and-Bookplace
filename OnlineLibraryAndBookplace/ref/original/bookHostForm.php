<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Host Registration</title>
    <link rel="icon" href="images/AppIcon.png">
    <link rel="stylesheet" href="styles/userStyles.css">
</head>
<body>
    
    <center>
    <h3>Book Host Registration</h3>
    <form method="post" action="bookHostAction.php">
        <table>
            <tr>
                <td><label for="bhname">Name</label></td>
                <td><input type="text" name="bhname" required></td>
            </tr>
            <tr>
                <td><label for="bhmail">Email</label></td>
                <td><input type="email" name="bhmail" pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" required></td>
            </tr>
            <tr>
                <td><label for="bhpas" >Set Password</label></td>
                <td><input type="password" name="bhpas" required></td>
            </tr>
            <tr>
                <td><label for="bhcpas">Confirm Password</label></td>
                <td><input type="password" name="bhcpas" required></td>
            </tr>
            <tr>
                <td><label for="pno">Phone No.</label></td>
                <td><input type="number" name="pno" required></td>
            </tr>   
            <tr>
                <td><label for="bhpinc">Pin Code</label></td>
                <td><input type="number" name="bhpinc" required></td>
            </tr> 
            <tr>
                <td><label for="bhcity">City</label></td>
                <td><input type="text" name="bhcity" required></td>
            </tr> 
            <tr>
                <td><label for="bhstate">State</label></td>
                <td><input type="text" name="bhstate" required></td>
            </tr> 
            <tr>
                <td><label for="bhaddr">Address</label></td>
                <td><input type="text" name="bhaddr" required></td>
            </tr> 
        </table>
        <br><br>
        <button type="submit">Register</button>
        
    </form>
    </center>
    

    <script>
        function validate_pass() {
            
            if(document.form.pas.value != document.form.cpas.value) {
                alert("Please Check Your Password");
                document.form.cpas.focus();
                return false;
            }
        }
        document.getElementById("bhcpas").addEventListener("keyup", () => {
            validate_pass();
        }, false);

        function validate_phone(){
            if(!(document.form.pno.value.match(/^[6789]\d{9}$/))) {
                alert("Enter Valid Phone Number");
                document.form.pno.focus();
                return false;
            }
        }
        document.getElementById("bhcpas").addEventListener("keyup", () => {
            validate_phone();
        }, false);

        function validate_pincode(){
            if(!(document.form.pinc.value.match(/\d{6}$/))) {
                alert("Enter Valid Pincode Number");
                document.form.pinc.focus();
                return false;
            }
        }
        document.getElementById("bhcpas").addEventListener("keyup", () => {
            validate_pincode();
        }, false);
    </script>

</body>
</html>