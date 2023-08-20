<?php 
    include("connection.php");
    session_start();
    $isLogin=$_SESSION['isLogin'] ;
    
    if(!$isLogin){
        echo "Only registered users have access.";
        exit;
    }
    echo "hi, ". $_SESSION['username']."!";

    if(isset($_POST["submit"])){
        $title_ = $_POST["title"];   //save for category table
        $description_ = $_POST["description"];
        $price_ = $_POST["price"];          
        $category_ = $_POST["category"];

        $title = addslashes($_POST["title"]);   //use addslashes to allow special characters
        $description = addslashes($_POST["description"]);
        $price = addslashes($_POST["price"]);
        $category_with_comma = $_POST["category"]; //save it to make it an array without comma    
        $category = addslashes($_POST["category"]);       
        $username = $_SESSION['username'];

        //to get the latest item_id that was just created
        $fetchSQL = "SELECT MAX(item_id) from items";
        $row = mysqli_fetch_assoc(mysqli_query($conn, $fetchSQL));
        $item_id = $row['MAX(item_id)'] +1;

        $check = "SELECT * from items where username = '$username' and date = CURRENT_DATE()";  //BRING THIS USER'S REVIEWS FOR TODAY 
        $check_3posts = mysqli_query($conn, $check); 

        if(mysqli_num_rows($check_3posts) < 3){
            $query = "INSERT INTO items (item_id, title, description, date, price, category, username) VALUES('$item_id','$title','$description', CURRENT_DATE(), '$price','$category', '$username')";   
            mysqli_query($conn, $query);             

            //remove spaces and then remove commas and make them an array
            $category_with_comma = str_replace(' ', '', $category_with_comma);
            $categoryArray = explode(",", $category_with_comma); 

            //let's add rows to category table
            $insertSQL = "INSERT INTO categories (item_id, name) VALUES (?, ?)";
            $stmt = $conn->prepare($insertSQL);
            $stmt->bind_param('is', $item_id, $value);
            foreach ($categoryArray as $value) {
                $stmt->execute();
            }
            echo '<script> 
            window.location.href = "list.php";
            alert("Uploaded Successfully!")
            </script>';
        }
        else{
            echo '<script> 
            window.location.href = "list.php";
            alert("you can\'t create more than 3 postings a day")
            </script>';
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post an item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
  </head>
  <body>
     
    <div id="form">
        <form name="form" action=""  method="post" autocomplete="off">
            <h1 class= "mb-3">Post your item</h1>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Title</span>
                <input type="text"  name="title" class="form-control" placeholder="ex) iPhone 13 mini" aria-label="Title" aria-describedby="basic-addon1" required value="">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Description</span>
                <textarea type="text" style = "height:150px"  name="description" class="form-control" placeholder="ex) I barely used it. it's like new." aria-label="Description" required value=""></textarea></b>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Category</span>
                <input type="text"  name="category" class="form-control" placeholder="ex) electronic, cellphone, apple" aria-label="Category" aria-describedby="basic-addon1" required value="">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input type="text" name="price" class="form-control" placeholder="ex) 500" aria-label="Amount (to the nearest dollar)" required value="">
                <span class="input-group-text">.00</span>
            </div>

            <input class="btn btn-success btn-lg" type="submit"  id="btn" value="Submit" name = "submit"/></br></br>
        </form>
        <a class="btn btn-primary btn-lg" href="list.php" role="button">item list</a>
        <a class="btn btn-secondary btn-lg" href="logout.php" role="button">Log out</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
  </body>
</html>


