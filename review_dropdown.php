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

    // if(isset($_POST["submit"])){
    //     $title_ = $_POST["title"];   //save for category table
    //     $description_ = $_POST["description"];
    //     $price_ = $_POST["price"];          
    //     $category_ = $_POST["category"];

    //     $title = addslashes($_POST["title"]);   //use addslashes to allow special characters
    //     $description = addslashes($_POST["description"]);
    //     $price = addslashes($_POST["price"]);
    //     $category_with_comma = $_POST["category"]; //save it to make it an array without comma    
    //     $category = addslashes($_POST["category"]);
       
    //     $username = $_SESSION['username'];
    //     $query = "INSERT INTO items (title, description, date, price, category, username) VALUES('$title','$description', CURRENT_DATE(), '$price','$category', '$username')";   
    //     mysqli_query($conn, $query);     
        

    //     //to get the latest item_id that was just created
    //     $fetchSQL = "SELECT MAX(item_id) from items";
    //     $row = mysqli_fetch_assoc(mysqli_query($conn, $fetchSQL));
    //     $item_id = $row['MAX(item_id)'];  

    //     //remove commas and make them an array
    //     $categoryArray = explode(",", $category_with_comma); 

    //     //let's add rows to category table
    //     $insertSQL = "INSERT INTO categories (item_id, name) VALUES (?, ?)";
    //     $stmt = $conn->prepare($insertSQL);
    //     $stmt->bind_param('is', $item_id, $value);
    //     foreach ($categoryArray as $value) {
    //         $stmt->execute();
    //     }
    //     echo '<script> 
    //     window.location.href = "list.php";
    //     alert("Uploaded Successfully!")
    //     </script>';
    // }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>write a review</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
  </head>
  <body>
  <h1><?php echo $row['title']?></h1>
    <table class="table table-bordered mb-3" >
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

    <div class="dropdown mb-3">    
        <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-pressed="false">
        Select score            
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=excellent">excellent</a></li>
            <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=good">good</a></li>
            <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=fair">fair</a></li>
            <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=poor">poor</a></li>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js/bootstrap.bundle.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>


