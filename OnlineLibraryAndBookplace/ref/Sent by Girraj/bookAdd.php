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
<form method="post" action="bookAddAction.php" name="myForm" onsubmit="validateForm()">   
        <div class="form">
            <div class="title">Add a Book</div>
            <div class="subtitle">Add details of the book</div>
            <div class="input-container ic1">
              <!-- <input id="firstname" class="input" type="text" placeholder=" " required name=""/>
              <div class="cut cut-short" style="width: 60px;"></div>
              <label for="firstname" class="placeholder">Book Cover</label> -->
            </div>

            
        <div class="input-container ic2">
                <input id="isbn" class="input" type="number" placeholder=" " required name="isbn"/>
                <div class="cut cut-short" style="width: 55px;"></div>
                <label for="isbn" class="placeholder">ISBN</label>
        </div>

        <div class="input-container ic2">
            <input id="title" class="input" type="text" placeholder=" " required name="title"/>
            <div class="cut cut-short" style="width: 50px;"></div>
            <label for="title" class="placeholder">Title</label>
        </div>

        
        <div class="input-container ic2">
            <select name="genre" class="input" name="genre">
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
            <div class="cut cut-short" style="width: 70px;"></div>
            <label for="genre" class="placeholder">Genre</label>
        </div>

        <div class="input-container ic2">
            <input id="pub_name" class="input" type="text" placeholder=" " required name="pub_name"/>
            <div class="cut cut-short" style="width: 120px;"></div>
            <label for="pub_name" class="placeholder">Publication Name</label>
        </div>

        <div class="input-container ic2">
            <input id="quant" class="input" type="number" placeholder=" " required name="quant"/>
            <div class="cut cut-short" style="width: 70px;"></div>
            <label for="quant" class="placeholder">Quantity</label>
        </div>

        <div class="input-container ic2">
            <input id="author" class="input" type="text" placeholder=" " required name="author"/>
            <div class="cut cut-short" style="width: 60px;"></div>
            <label for="author" class="placeholder">Author</label>
        </div>

        <div class="input-container ic2">
            <input id="pub_year" class="input" type="number" placeholder=" " required name="pub_year"/>
            <div class="cut cut-short" style="width:110px;"></div>
            <label for="pub_year" class="placeholder">Publication Year</label>
        </div>

       
        <input type="hidden" name="type" value="1">
        
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