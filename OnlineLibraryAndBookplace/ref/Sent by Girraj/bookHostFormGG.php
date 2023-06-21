<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <title>Document</title>
</head>
<body>
    <form method="post" action="bookHostAction.php">
    <div class="form" >
        <div class="title">Welcome</div>
        <div class="subtitle">Let's create your account!</div>
        <div class="input-container ic1">
          <input id="firstname" class="input" type="text" placeholder=" " required name="bhname"/>
          <div class="cut cut-short" style="width: 70px;"></div>
          <label for="firstname" class="placeholder">Name</label>
        </div>
        <div class="input-container ic2">
          <input id="lastname" class="input" type="text" placeholder=" " required name="bhmail"/>
          <div class="cut cut-short" style="width: 7s0px;"></div>
          <label for="lastname" class="placeholder">Email</label>
        </div>
        <div class="input-container ic2">
          <input id="email" class="input" type="text" placeholder=" " required name="bhcpas"/>
          <div class="cut cut-short" style="width: 100px;"></div>
          <label for="email" class="placeholder">Set Password</>
        </div>
        <div class="input-container ic2">
            <input name="bhcpas" class="input" type="text" placeholder=" " required name="b"/>
            <div class="cut cut-short" style="width: 130px;"></div>
            <label for="bhcpas" class="placeholder" >Confirm Password</>
        </div>

        <div class="input-container ic2">
            <input name="pno" class="input" type="number" placeholder=" " required name="pno"/>
            <div class="cut cut-short" style="width: 80px;"></div>
            <label for="pno" class="placeholder" >Phone No.</>
        </div>

        <div class="input-container ic2">
            <input name="bhpinc" class="input" type="number" placeholder=" " required name="bhpinc"/>
            <div class="cut cut-short" style="width: 80px;"></div>
            <label for="bhpinc" class="placeholder" >Pin Code</>
        </div>

        <div class="input-container ic2">
            <input name="bhcity" class="input" type="text" placeholder=" " required name="bhcity"/>
            <div class="cut cut-short" style="width: 50px;"></div>
            <label for="bhcity" class="placeholder" >City</>
        </div>

        <div class="input-container ic2">
            <input name="bhstate" class="input" type="text" placeholder=" " required name="bhstate"/>
            <div class="cut cut-short" style="width: 70px;"></div>
            <label for="bhstate" class="placeholder" >State</>
        </div>

        <div class="input-container ic2">
            <input name="bhaddr" class="input" type="text" placeholder=" " required name="bhaddr"/>
            <div class="cut cut-short" style="width: 80px;"></div>
            <label for="bhaddr" class="placeholder" >Address</>
        </div>

        <button type="text" class="submit">Register</button>
      </div>
    </form>

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