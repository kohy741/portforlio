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
      $category = "";
      $search = addslashes($_POST['category']);
      header("Location: filtered.php?category=$search");
    }

    $category = $_GET['category'];
    $sql = "SELECT items.*  FROM items  JOIN categories ON items.item_id = categories.item_id WHERE categories.name = '$category' order by item_id desc";  
    $result = mysqli_query($conn, $sql);
    
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> category: <?php echo $category ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="mb-3">Item list</h1>

    <div>
      <a class="btn btn-primary btn-sm mb-4" href="home.php" role="button">back to home</a>
      <a class="btn btn-secondary btn-sm mb-4" href="logout.php" role="button">Log out</a></br>
      <a class="btn btn-success btn-lg mb-3" href="insert.php" role="button">create a posting</a>
    </div>

    <div id="form">
      <form action="" method="post" >
          <label>Search by category : </label>
          <input type="text" name="category" id = "category" required value="">
          <input type="submit" id="btn" value="search" name = "submit"/>
      </form> 
    </div>

    <div>
      <button type="button" class="btn btn-dark" onclick="location.href='list.php'">
      <?php echo stripslashes($category) ?> <span class="badge text-bg-dark">x</span>
      </button>
    </div>


    
    

    <div>    
      <table class="table">
          <thead>
              <tr>
              <th scope="col">#</th>
              <th scope="col">Item</th>
              <th scope="col">Price</th>
              <th scope="col">Category</th>
              <th scope="col">Username</th>
              <th scope="col">Date</th>
              </tr>
          </thead>
          <tbody>
          <?php 
                while($row = mysqli_fetch_assoc($result)){ ?>
                  <tr>
                      <?php 
                        $id = $row['item_id'];
                        $num_of_reviews = "SELECT count(*)  from reviews where item_id = $id";
                        $a = mysqli_query($conn, $num_of_reviews);
                        $r = mysqli_fetch_assoc($a);
                      ?>
                      <th scope="row"><?php echo $row['item_id']; ?></th>
                      <td><a href="view.php?item_id=<?php echo $row['item_id']?>"><?php echo $row['title']." (".$r["count(*)"].")" ?></a></td>
                      <td><?php echo '$'.$row['price']; ?></td>
                      <td><?php echo $row['category']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['date']; ?></td>
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