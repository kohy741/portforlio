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
        $date = $_POST['date'];
        echo '<script> 
        window.location.href = "4x.php?date='.$date.'";
        </script>';
    }
    
?>

<!doctype html>
<html lang="en">


<head>
    <title>4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>

<body>

    <br><br><a class="btn btn-dark btn-lg" href="cards.php" role="button">Back</a>
    <div id="form">
        
        <form name="form" action=""  method="post" autocomplete="off">
        <h1 class="pt-4 pb-2">Users who posted the most number of items on a certain date</h1>
        
            <div class="row form-group">
                <label for="date" class="col-sm-1 col-form-label">Date</label>
                <div class="col-sm-4">
                    <div class="input-group date" id="datepicker">
                        <input type="text" name="date" class="form-control" required value="">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white d-block">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>        
            <input class="btn btn-success btn-lg" type="submit"  id="btn" value="Submit" name = "submit"/></br></br>
        </form>

    </div>

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                format : "yyyy-mm-dd"
            });
        });
    </script>


</body>

</html>