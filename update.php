<?php
session_start();
include("config.php");
$roomid = $_GET["id"];
$query="SELECT * FROM `room` WHERE `R_id`=$roomid";
$res1=mysqli_query($conn,$query);
$row1=mysqli_fetch_array($res1);
$roomno=$row1['room_no'];
$price=$row1['price'];
$block=$row1['block_no'];

$db_fields = array('room_no','price','block_no');
$sqlfield = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    foreach($db_fields as $fieldname) {
        if (!empty($_POST[$fieldname])) {
            $sqlfield .= "$fieldname = '{$_POST[$fieldname]}',";
        }
    }
    $sqlfield = rtrim($sqlfield, ',');
    $sql = "UPDATE room SET $sqlfield WHERE R_id = $roomid";
    if (mysqli_query($conn,$sql)) {
            echo "<script type='text/javascript'>alert('Details updates successfully');
            window.location='adminroom.php';</script>";
            die;
    } else{
            echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
            window.location='adminroom.php';</script>";
            die;
    }
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Room</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/admin style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Room</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Room Number</label>
                            <input type="text" name="room_no" class="form-control" value="<?php echo $roomno; ?>">
                        </div>
                        <div class="form-group">
                            <label>Block Number</label>
                            <input type="text" name="block_no" class="form-control" value="<?php echo $block; ?>" >
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                        </div>
                        <button type="submit" class="btn btn-info" name="submit"">Submit</button>
                        <a href="adminroom.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
        <datalist id="mylist">
   <option value="Sold">
   <option value="Unsold">
</body>
</html>