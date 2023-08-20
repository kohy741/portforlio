<?php 

    include("connection.php");
    session_start();
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }
    echo "hi, ". $_SESSION['username']."!";

    $date = $_GET['date'];
        $sql = "SELECT username, COUNT(*) as total_items
        FROM items
        WHERE date = '$date' 
        GROUP BY username
        HAVING total_items = (
            SELECT MAX(item_count)
            FROM (
                SELECT COUNT(*) as item_count
                FROM items
                WHERE date = '$date' 
                GROUP BY username
            ) AS item_counts
        );";
        $result = mysqli_query($conn, $sql);  

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <br><br><a class="btn btn-dark btn-lg" href="4.php" role="button">back</a>
    <h1 class="mb-3">Users who posted the most number of items on <?php echo $date ?></h1>

    <div>        
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Username</th>
                <th scope="col">how many</th>
                </tr>
            </thead>
            <tbody>
                <?php             
                    while($row = mysqli_fetch_assoc($result)){ ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['total_items'];?></td>

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