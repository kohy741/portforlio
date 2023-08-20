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
    $score = $_GET['score'];
    $detail = "SELECT * from items where item_id = $item_id";  
    $result = mysqli_query($conn, $detail);  
    $row = mysqli_fetch_assoc($result);


    if(isset($_POST["submit"])){
        $description_ = $_POST["description"];
        $description = addslashes($_POST["description"]);       
        $username = $_SESSION['username'];

        $check = "SELECT * from reviews where username = '$username' and date = CURRENT_DATE()";  //BRING THIS USER'S REVIEWS FOR TODAY 
        $check_3reviews = mysqli_query($conn, $check); 

        if(mysqli_num_rows($check_3reviews) < 3 && $row['username'] != $username){   //no more than 3 postings
            $query = "INSERT INTO reviews VALUES('$item_id','$score','$username','$description',CURRENT_DATE())";   
            mysqli_query($conn, $query);       
    
            echo '<script> 
            window.location.href = "view.php?item_id='.$item_id.'";
            alert("Review Uploaded")
            </script>';
        }  
        else if($row['username'] == $username) {
            echo  '<script>
            window.location.href = "view.php?item_id='.$item_id.'";
            alert("you can\'t write a review to your own item.")
            </script>';
        }
        else if(mysqli_num_rows($check_3reviews) == 3){  
            echo  '<script>
            window.location.href = "view.php?item_id='.$item_id.'";
            alert("failed. you already posted 3 reviews today")
            </script>';
        }
    }
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
    <table class="table table-bordered mb-3">
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
    <div id="form">
        
        <form name="form" action=""  method="post" autocomplete="off">

            <div class="dropdown mb-3">
            
                <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-pressed="false">
                <span class="a-dropdown-label">score: </span>
                <span class="a-dropdown-prompt"> <?php echo $score ?> </span>
                    
                </button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=excellent">excellent</a></li>
                <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=good">good</a></li>
                <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=fair">fair</a></li>
                <li><a class="dropdown-item" href="review_write.php?item_id=<?php echo $item_id?>&score=poor">poor</a></li>
                </ul>
                
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Description</span>
                <textarea type="text" style = "height:150px"  name="description" class="form-control" placeholder="write your review" aria-label="Description" required value=""></textarea></b>
            </div>

            <input class="btn btn-success btn-lg" type="submit"  id="btn" value="Submit" name = "submit"/>
            <a class="btn btn-secondary btn-danger btn-lg" href="view.php?item_id=<?php echo $item_id?>" role="button">Cancel</a>
        </form>



        
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js/bootstrap.bundle.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>


