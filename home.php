<?php 
    session_start();  
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">    
</head>
<body>
    <div id="form">
        <h1>This is Home</h1>
            <form name="form" action="" onsubmit="return isvalid()" method="POST">
            <p> <?php echo "welcome [".$_SESSION['username']."]!";?></p></br>
            <a href="insert.php">Post an item</a></br>
            <a href="list.php">Show item list</a></br>
            <a href="cards.php">Show other lists</a></br>
            <a href="logout.php">Log out</a></br>
            
            </form>
    </div>
</body>
</html>