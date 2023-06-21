<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE, APP ICON AND CSS -->
	<title>Librarian Registration</title>
    <link rel="icon" href="images/AppIcon.png">
    <link rel="stylesheet" href="styles/authStyles.css">

    <style>
        a {
            text-decoration: none;
            color: lightgray;
        }
        a:visited {
            color: lightgray;
        }
        a:hover {
            color: white;
        }
        body{
            background-image: url('images/bg.jpg');
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .form{
            height: 410px;
        }
        #formPart1{
            border-bottom-right-radius: 0px;
            border-top-right-radius: 0px;
        }
        #formPart2{
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
        }
        .navbar {
            font-family: Helvetica, sans-serif;
            position: fixed;
            top: 20px;
        }
        .title {
            margin-top: 0px;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
	<div class="navbar">
		<img src="images/AppIcon.png" alt="Logo" height="38" width="38" style=" border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
		<h2 style="display: inline;">Online Library System and Bookplace</h2>
	</div>
    
    <table>
    <form method="post" action="librarianAction.php" name="form1" onsubmit="validateForm()">
        <div class="form" id="formPart1">
            <div class="input-container ic1" style="margin-top: -5px;">
                <div class="title" style="color: white; font-size:1.6rem;">Library Registration</div>
                <div class="subtitle">Add Library Details</div>
            </div>

            <div class="input-container ic2">
                <input name="lib_name" id="lib_name" class="input" type="text" placeholder=" " required/>
                <div class="cut cut-short" style="width: 90px;"></div>
                <label for="lib_name" class="placeholder">Library Name</label>
            </div>

            <div class="input-container ic2">
                <input name="lib_pass" id="lib_pass" class="input" type="password" placeholder=" " required/>
                <div class="cut cut-short" style="width: 75px;"></div>
                <label for="lib_pass" class="placeholder">Password</label>
            </div>

            <div class="input-container ic2">
                <input name="lib_cpass" id="lib_cpass" class="input" type="password" placeholder=" " required/>
                <div class="cut cut-short" style="width: 120px;"></div>
                <label for="lib_cpass" class="placeholder">Confirm Password</label>

                <div class="input-container ic2">
                <input name="lib_mail" id="lib_mail" class="input" type="text" placeholder=" " pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" id="email" name="lib_mail" required/>
                <div class="cut cut-short" style="width: 85px;"></div>
                <label for="lib_mail" class="placeholder">Library Mail</label>
            </div>
            </div>
        </div>
        <div class="form" id="formPart2">
            <div class="input-container ic1" style="margin-top: 15px;">
                <select name="lib_type" id="lib_type" class="input">
                    <option value="Public">Public</option>
                    <option value="Private">Private</option>
                    <option value="University">University</option>
                </select>
                <div class="cut cut-short" style="width: 90px;"></div>
                <label for="lib_type" class="placeholder">Library Type</label>
            </div>

            <div class="input-container ic2">
                <input name="lib_pin" id="lib_pin" class="input" type="number" placeholder=" " pattern="[0-9]{6}$" id="pinc" name="lib_pin" required/>
                <div class="cut cut-short" style="width: 65px;"></div>
                <label for="lib_pin" class="placeholder">Pincode</label>
            </div>
            
            <div class="input-container ic2">
                <input name="lib_addr" id="lib_addr" class="input" type="text" placeholder=" " required/>
                <div class="cut cut-short" style="width: 65px;"></div>
                <label for="lib_addr" class="placeholder">Address</label>
            </div>

            <button type="text" class="submit">Register</button>

            <div class="input-container ic2">
                <center style="font-family:Helvetica, sans-serif">
                    <p style="display:inline-block; color:lightblue; margin-top:0px;">Already Registered?</p>
                    <a href="librarianLogin.php" style="margin-top:0px;">  Librarian Login</a><br><br>
                </center>
            </div>
        </div>
    </form>
    </div>
    </table>

    <script>
        function validate_pass() {
            if(document.form1.lib_pass.value != document.form1.lib_cpass.value) {
                alert("Please Check Your Password");
                document.form1.lib_cpass.focus();
                return false;
            }
        }
        function validate_pincode(){
            if(!(document.form1.lib_pin.value.match(/\d{6}$/))) {
                alert("Enter Valid Pincode Number");
                document.form1.lib_pin.focus();
                return false;
            }
        }

        function validateForm(event){
            event.preventDefault();
            if(!validate_pass()){
                console.log('Password and Confirm Password not same!');
            }
            if(!validate_pincode()){
                console.log('Pincode must be 6 digits!');
            }
        }
    </script>
</body>
</html>