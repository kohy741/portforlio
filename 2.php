<?php 
    include("connection.php");
    session_start();
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }
    echo "hi, ". $_SESSION['username']."!";


    if (isset($_POST['submit'])) {
        $category_x = $_POST['category_x'];
        $category_y = $_POST['category_y'];        
        $category_x = mysqli_real_escape_string($conn, $category_x);
        $category_y = mysqli_real_escape_string($conn, $category_y);

        $sql = "SELECT I.username, I.date, I.item_id, I.title, I.price, I.category
                FROM items I
                JOIN (
                    SELECT username, DATE(date) AS post_date
                    FROM items
                    WHERE item_id IN (SELECT item_id FROM categories WHERE name IN ('nike', 'supplement'))
                    GROUP BY username, DATE(date)
                    HAVING COUNT(*) >= 2
                ) grouped_users ON I.username = grouped_users.username AND DATE(I.date) = grouped_users.post_date
                WHERE I.category LIKE '%nike%' OR I.category LIKE '%supplement%';";
        
        //this sql results the same
        //  $sql = "SELECT username,date,item_id,title,price,category FROM (select *
        //         FROM items
        //         where date = (SELECT date
        //         FROM (select * from items where item_id in (SELECT item_id FROM categories where name in ('$category_x', '$category_y'))) as yoyoyo
        //         GROUP BY date
        //         HAVING COUNT(*) >= 2) and 
        //         username = (SELECT username
        //         FROM (select * from items where item_id in (SELECT item_id FROM categories where name in ('$category_x', '$category_y'))) as yoyoyo
        //         WHERE date IN (
        //             SELECT date
        //             FROM (select * from items where item_id in (SELECT item_id FROM categories where name in ('$category_x', '$category_y'))) as yoyoyo
        //             GROUP BY date
        //             HAVING COUNT(*) >= 2
        //         )
        //         GROUP BY username
        //         HAVING COUNT(*) >= 2)) as hehehe  WHERE category LIKE '%$category_x%' OR category LIKE '%$category_y%';";  

        
         $result = mysqli_query($conn, $sql);

         echo '<script> 
         window.location.href = "2x.php?category_x='.$category_x.'&category_y='.$category_y.'";
         </script>';
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <br><br><a class="btn btn-dark btn-lg" href="cards.php" role="button">back</a>
    <h1 class="mb-3">Users who posted at least two items that are posted on the same day</h1>

    <form method="POST">
        <div class="mb-3">
            <label for="category_x" class="form-label">category X</label>
            <input type="text" class="form-control" id="category_x" name = "category_x" required value="">
        </div>
        <div class="mb-3">
            <label for="category_y" class="form-label">category Y</label>
            <input type="text" class="form-control" id="category_y" name = "category_y" required value="">
        </div>

        <button type="submit" class="btn btn-primary btn-lg" name = "submit">Submit</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>