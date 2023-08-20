<?php 
    include("connection.php");
    session_start();
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }
    echo "hi, ". $_SESSION['username']."!";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>other lists</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <br><br>
    <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title">1</h5>
            <p class="card-text">the most expensive items in each category.</p>
            <a href="1.php" class="btn btn-primary">show list</a>
        </div>
    </div>
    <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title">2</h5>
            <p class="card-text">the users who posted at least two items that are posted on the same day.</p>
            <a href="2.php" class="btn btn-primary">show list</a>
        </div>
    </div>
    <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title">3</h5>
            <p class="card-text">the items posted by user X, such that all the comments are "Excellent" or "good" for these items.</p>
            <a href="3.php" class="btn btn-primary">show list</a>
        </div>
    </div>
    <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title">4</h5>
            <p class="card-text">the users who posted the most number of items on a certain day</p>
            <a href="4.php" class="btn btn-primary">show list</a>
        </div>
    </div>
    <div class="card w-75 mb-3">
        <div class="card-body">
            <h5 class="card-title">5</h5>
            <p class="card-text">the users who posted some reviews, but each of them is "poor".</p>
            <a href="5.php" class="btn btn-primary">show list</a>
        </div>
    </div>
    <div class="card w-75 mb-5">
        <div class="card-body">
            <h5 class="card-title">6</h5>
            <p class="card-text">the users such that each item they posted so far never received any "poor" reviews.</p>
            <a href="6.php" class="btn btn-primary">show list</a>
        </div>
    </div>

    <a class="btn btn-dark btn-lg mb-4" href="home.php" role="button">back to home</a>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>