<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Registration</title>

    <link rel="icon" href="images/AppIcon.png">

    <style>
        #em_err {
            color: red;
            font-weight: 600;
            display: none;
        }

        #pin_err {
            color: red;
            font-weight: 600;
            display: none;
        }
    </style>
</head>

<body>
    <h1>Librarian Registration</h1>
    <form method="post" action="librarianAction.php">
        <table>
            <tr>
                <td><label for="lib_name">Name</label></td>
                <td><input type="text" name="lib_name" required></td>
            </tr>
            <tr>
                <td><label for="lib_pass">Password</label></td>
                <td><input type="password" name="lib_pass" required></td>
            </tr>
            <tr>
                <td><label for="lib_mail">Mail</label></td>
                <td>
                    <input type="text" pattern="[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$" id="email" name="lib_mail" required>
                    <p id="em_err">Invalid Email</p>
                </td>
                
            </tr>
            <tr>
                <!-- <td><label for="lib_type">Type</label></td>
                <td><input type="text" name="lib_type" required></td> -->
                <td><label for="lib_type">Library Type</label></td>
                <td>
                    <select name="lib_type" id="lib_type">
                        <option value="Public">Public</option>
                        <option value="Private">Private</option>
                        <option value="University">University</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="lib_pin">Pincode</label></td>
                <td>
                    <input type="text" pattern="[0-9]{6}$" id="pinc" name="lib_pin" required>
                    <p id="pin_err">Invalid Pincode</p>
                </td>
                
            </tr>
            <tr>
                <td><label for="lib_addr">Address</label></td>
                <td><input type="text" name="lib_addr" required></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="submit">
                </td>
            </tr>
        </table>
    </form>

    <script>
        function validate_email() {

            let patt = /^[A-Za-z0-9]{2,}@[a-z]{2,}.[a-z]{2,}$/;
            if (!patt.test(document.getElementById("email").value)) {
                document.getElementById("em_err").style.display = "inline";
            } else {

                document.getElementById("em_err").style.display = "none";
            }
        }
        document.getElementById("email").addEventListener("keyup", () => {
            validate_email();
        }, false);

        function validate_pinc() {
            let patt = /^[0-9]{6}$/;
            if (!patt.test(document.getElementById("pinc").value)) {
                document.getElementById("pin_err").style.display = "inline";
            } else {

                document.getElementById("pin_err").style.display = "none";
            }
        }
        document.getElementById("pinc").addEventListener("keyup", () => {
            validate_pinc();
        }, false);
    </script>
</body>

</html>