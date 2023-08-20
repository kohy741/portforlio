<?php 
    include("connection.php");
    session_start();
    $_SESSION['isLogin']="";
    if (isset($_POST['submit'])) {
        $username = $_POST['user'];
        $password = $_POST['pass'];
        
        //sql injection prevention
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);


        $sql = "SELECT * from users where username = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);               
        
        if(mysqli_num_rows($result) == 1){  
            $row = mysqli_fetch_assoc($result);
            $_SESSION['isLogin'] = 1;
            $_SESSION['username'] = $row['username'];
            header("Location: home.php");
        }  
        else{  
            echo  '<script>
                        window.location.href = "index.php";
                        alert("Login failed. Invalid username or password!!")
                    </script>';
        }     
    }
?>
<!DOCTYPE hytml>
<html lang = "en">
<html>
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">        
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>        
        <div id="form" >
            <h1>Login</h1>
                <form name="form" action="" onsubmit="return isvalid()" method="POST">
                <label>Username or Email ID:</label></br>
                <input type="text" id="user" name="user"></br></br>
                <label>Password:</label></br>
                <input type="password" id="pass" name="pass"></br></br>
                <input type="submit" id="btn" value="Login" name = "submit"/></br></br>
                <a href="signup.php">Sign up</a>
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