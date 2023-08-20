
<?php
    include("connection.php");
    session_start();
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }   
    echo "hi, ". $_SESSION['username']."!";
    $item_id = $_GET['item_id'];
    $detail = "select * from items where item_id = $item_id";  
    $result = mysqli_query($conn, $detail);  
    $row = mysqli_fetch_assoc($result);

    $reviews = "select * from reviews where item_id = $item_id";
    $result2 = mysqli_query($conn, $reviews);  
    


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>view</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1><?php echo $row['title']?></h1>
    <table class="table table-bordered table-striped mb-3" >
        <tbody>
            <tr>
                <th scope="col">Description</th>
                <td><?php echo nl2br($row['description']) ?></td>
            </tr>

            <tr>
                <th scope="col">Seller</th>
                <td><?php echo $row['username']?></td>     
            </tr>

            <tr>
                <th scope="col">Uploaded date</th>
                <td><?php echo $row['date']?></td>     
            </tr>

            <tr>
                <th scope="col">Price</th>
                <td><?php echo "$".$row['price']?></td>
            </tr>

            <tr>
                <th scope="col">Category</th>
                <td><?php echo $row['category']?></td>
            </tr>
        </tbody>
    </table>
    <button type="button" onclick="location.href='review_dropdown.php?item_id=<?php echo $item_id?>'" class="btn btn-info btn-lg mb-1">Write a review</button></br>
    <a class="btn btn-dark mb-5" href="list.php" role="button">item list</a>

    <div>
        <h3> reviews
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Score</th>
                <th scope="col">Description</th>
                <th scope="col">Username</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                while($row2 = mysqli_fetch_assoc($result2)){ ?>
                    <tr>
                        <td><?php echo $row2['score']; ?></td>
                        <td><?php echo $row2['description']; ?></td>
                        <td><?php echo $row2['username']; ?></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>