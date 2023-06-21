<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Books</title>
    <link rel="icon" href="images/AppIcon.png">

    <style>
    </style>
</head>

<body>
    <h1>Add a Book</h1>
    <table>
        <form method="post" action="bookAddAction.php" name="myForm" onsubmit="validateForm()">
            <tr>
                <td><label for="isbn">ISBN</label></td>
                <td><input type="number" name="isbn"></td>
            </tr>
            <tr>
                <td><label for="title">Title</label></td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td><label for="genre">Genre</label></td>
                <!-- <td><input type="text" name="genre"></td> -->
                <td>
                <select name="genre">
                    <option value="Action">Action</option>
                    <option value="Biography">Biography</option>
                    <option value="Comic">Comic</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Fiction">Fiction</option>
                    <option value="History">History</option>
                    <option value="Horror">Horror</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Romance">Romance</option>
                    <option value="Science">Science</option>
                    <option value="Self-Improvement">Self-Improvement</option>
                    <option value="Textbook">Textbook</option>
                    <option value="Thriller">Thriller</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="pub_name">Publication Name</label></td>
                <td><input type="text" name="pub_name"></td>
            </tr>
            <tr>
                <td><label for="quant">Quantity</label></td>
                <td><input type="number" name="quant"></td>
            </tr>
            <tr>
                <td><label for="author">Author</label></td>
                <td><input type="text" name="author"></td>
            </tr>
            <tr>
                <td><label for="pub_year">Publication Year</label></td>
                <td><input type="number" name="pub_year"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="type" value="1"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </form>
    </table>
    

    <script type="text/javascript">
        function validateForm() {
            if (document.myForm.isbn.value.length == "" || document.myForm.isbn.value.length != 13) {
                alert("ISBN Number should be 13 digit");
                document.myForm.isbn.focus();
                return false;
            }

            if (document.myForm.title.value == "") {
                alert("Please provide your Title!");
                document.myForm.title.focus();
                return false;
            }

            if (document.myForm.genre.value == "") {
                alert("Please specify your Genre!");
                document.myForm.genre.focus();
                return false;
            }

            if (document.myForm.pub_name.value == "") {
                alert("Please enter your Publication Name!");
                document.myForm.pub_name.focus();
                return false;
            }

            if (document.myForm.quant.value == "") {
                alert("Please specify the Quantity!");
                document.myForm.quant.focus();
                return false;
            }

            if (document.myForm.author.value == "") {
                alert("Please specify the Author!");
                document.myForm.author.focus();
                return false;
            }

            if (document.myForm.pub_year.value == "") {
                alert("Please enter the Publication Year!");
                return false;
            }
            else {
                let x = document.myForm.pub_year.value;
                let y = parseInt(x);
                console.log(y)
                console.log(typeof(y))
                if (y < 1967) {
                    alert("Publication Year should be after 1967!");
                }
                document.myForm.pub_year.focus();
                return false;
            }
            document.myForm.submit();
            return (true);
        }
    </script>
</body>

</html>