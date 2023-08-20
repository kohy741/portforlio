<?php
    
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $db_name = "phase1_loginpage";  
    $conn = new mysqli($servername, $username, $password, $db_name, 3306);
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);
    }
    echo " ";
?>