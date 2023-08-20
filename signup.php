<?php 
    include("connection.php");
    if(isset($_POST["submit"])){
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
        if(mysqli_num_rows($duplicate) > 0){
            echo
            "<script> alert('Username or Email Has Already Taken'); </script>";
        }
        else{
            if($password == $confirmpassword){
                $query = "INSERT INTO users VALUES('$username','$password','$firstname','$lastname','$email')";
                mysqli_query($conn, $query);
                echo
                '<script> window.location.href = "index.php";
                alert("Registration Successful"); 
                </script>';
            }
            else{
                echo
                "<script> alert('Password Does Not Match'); </script>";
            }
        }
    }
?>

<!DOCTYPE hytml>
<html lang = "en">
<html>
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <title>Sign up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>        
        <div id="form">
            <h1>Registration</h1>
            <form class="" action="" method="post" autocomplete="off">
                <label for="username">Username : </label><br>
                <input type="text" name="username" id = "username" required value=""> <br><br>
                <label for="password">Password : </label><br>
                <input type="password" name="password" id = "password" required value=""> <br><br>
                <label for="confirmpassword">Confirm Password : </label><br>
                <input type="password" name="confirmpassword" id = "confirmpassword" required value=""> <br><br>
                <label for="firstname">First Name : </label><br>
                <input type="text" name="firstname" id = "firstname" required value=""> <br><br>
                <label for="lastname">Last Name : </label><br>
                <input type="text" name="lastname" id = "lastname" required value=""> <br><br>
                <label for="email">Email : </label><br>
                <input type="email" name="email" id = "email" required value=""> <br><br>

                <input type="submit" id="btn" value="Signup" name = "submit"/></br></br></br>
                <a href="index.php"><-- Back to login</a>
            </form>
        </div>
        <script>
            function isvalid(){
                var user = document.form.user.value;
                var pass = document.form.pass.value;
                if(user.length=="" && pass.length==""){
                    alert(" Username and password field is empty!!!");
                    return false;
                }
                else if(user.length==""){
                    alert(" Username field is empty!!!");
                    return false;
                }
                else if(pass.length==""){
                    alert(" Password field is empty!!!");
                    return false;
                }
                
            }
        </script>
    </body>
</html>