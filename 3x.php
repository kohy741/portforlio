<?php 
    include("connection.php");
    session_start();
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }
    echo "hi, ". $_SESSION['username']."!";
    $username = $_GET['username'];

    $sql = "SELECT i.*
    FROM items i
    JOIN reviews r ON i.item_id = r.item_id
    WHERE i.username = '$username'
    AND (r.score = 'excellent' OR r.score = 'good')
    AND i.item_id NOT IN (
        SELECT item_id
        FROM reviews
        WHERE score = 'Poor'
    );";

    $result = mysqli_query($conn, $sql);
    
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <br><br><a class="btn btn-dark btn-lg" href="3.php" role="button">back</a>
    <h1 class="mb-3">the items posted by user X, such that all the comments are "Excellent" or "good" for these items.</h1>

    <div>        
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">username</th>
                <th scope="col">item#</th>
                <th scope="col">item</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <th scope="row"><?php echo $row['username']; ?></th>
                        <td><?php echo $row['item_id'];?></td>
                        <td><?php echo $row['title']; ?></td>
                    </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>