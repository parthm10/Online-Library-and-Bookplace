<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- TITLE, APP ICON AND CSS -->
	<title>Book Host Registration</title>
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
            margin-top: 50px;
            margin-bottom: 0px;
            overflow-y: hidden;
        }
        .form{
            height: 490px;
            margin-top: -15px;
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

    <!-- BOOK HOST REGISTRATION FORM -->
    <table>
    <form method="post" action="bookHostAction.php" name="form">
    <div class="form" id="formPart1">
        <div class="input-container ic1" style="margin-top: -5px;">
            <center>
                <div class="title" style="margin-top: -5px; font-size:1.8rem;">Book Host Registration</div>
            </center>
        </div>

        <div class="input-container ic1">
            <input name="bhname" class="input" type="text" placeholder=" " required/>
            <div class="cut cut-short" style="width: 55px;"></div>
            <label for="bhname" class="placeholder">Name</label>
        </div>

        <div class="input-container ic2">
            <input name="bhmail" class="input" type="text" placeholder=" " pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" required/>
            <div class="cut cut-short" style="width: 55px;"></div>
            <label for="bhmai" class="placeholder">Email</label>
        </div>

        <div class="input-container ic2">
            <input name="bhpass" class="input" type="password" placeholder=" " required/>
            <div class="cut cut-short" style="width: 95px;"></div>
            <label for="bhpass" class="placeholder">Set Password</>
        </div>

        <div class="input-container ic2">
            <input name="bhcpass" class="input" type="password" placeholder=" " required/>
            <div class="cut cut-short" style="width: 120px;"></div>
            <label for="bhcpass" class="placeholder">Confirm Password</>
        </div>

        <div class="input-container ic2">
            <input name="bhphone" class="input" type="number" placeholder=" " required/>
            <div class="cut cut-short" style="width: 80px;"></div>
            <label for="bhphone" class="placeholder">Phone No.</>
        </div>
    </div>

    <div class="form" id="formPart2">
        <div class="input-container ic2" style="margin-top: 5px;">
            <input name="bhpinc" class="input" type="number" placeholder=" " required/>
            <div class="cut cut-short" style="width: 65px;"></div>
            <label for="bhpinc" class="placeholder" >Pincode</>
        </div>

        <div class="input-container ic2">
            <input name="bhcity" class="input" type="text" placeholder=" " required/>
            <div class="cut cut-short" style="width: 45px;"></div>
            <label for="bhcity" class="placeholder" >City</>
        </div>

        <div class="input-container ic2">
            <input name="bhstate" class="input" type="text" placeholder=" " required/>
            <div class="cut cut-short" style="width: 50px;"></div>
            <label for="bhstate" class="placeholder" >State</>
        </div>

        <div class="input-container ic2">
            <input name="bhaddr" class="input" type="text" placeholder=" " required />
            <div class="cut cut-short" style="width: 65px;"></div>
            <label for="bhaddr" class="placeholder" >Address</>
        </div>

        <button type="text" class="submit" onclick="validateForm()">Register</button>

        <div class="input-container ic2">
                <center style="font-family:Helvetica, sans-serif">
                    <p style="display:inline-block; color:lightblue; margin-top:0px;">Already Registered?</p>
                    <a href="bookHostLogin.php" style="margin-top:0px;">Book Host Login</a><br><br>
                </center>
            </div>
      </div>
    </form>
    </table>

    <script type="text/javascript">
        function validate_phone(){
            if(!(document.form.bhphone.value.match(/^[6789]\d{9}$/))) {
                alert("Enter Valid Phone Number");
                document.form.bhphone.focus();
                return false;
            }
        }
        function validate_pass() {
            if(document.form.bhpass.value != document.form.bhcpass.value) {
                alert("Password and Confirm Password are not same!");
                document.form.bhcpass.focus();
                return false;
            }
        }
        function validate_pincode(){
            if(!(document.form.bhpinc.value.match(/\d{6}$/))) {
                alert("Enter Valid Pincode Number");
                document.form.bhpinc.focus();
                return false;
            }
        }

        function validateForm(event){
            event.preventDefault();
            if(!validate_phone()){
                console.log('Phone number must be having 10 digits!');
            }
            if(!validate_pass()){
                console.log('Password and Confirm Password are not same!');
            }
            if(!validate_pincode()){
                console.log('Pincode must be 6 digits!');
            }
        }
    </script>

</body>
</html>