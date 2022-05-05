<?php 
session_start();
require_once "config.php";
if(isset($_POST["submit"])){
  $room_no = $_POST["room"];
  $price = $_POST["price"];
  $block_no = $_POST["block"];
  $sql = "SELECT * FROM room WHERE room_no = $room_no";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0){
    echo "<script>alert('Room already created')</script>";
  }
  else{
    $sql = "INSERT INTO room (room_no,price,block_no,status,S_id) VALUES 
        ($room_no,'$price',$block_no,'unsold',NULL)";
    if(mysqli_query($conn,$sql)){
      echo "<script>alert('Inserted Successfully')</script>";
      }
    else{
      echo "<script>alert('Woops! Something Wrong Went')</script>";
    }
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
	  <link rel="stylesheet" href="/css/admin style.css">
    <script src="
https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
</head>

<body>

    <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">HOSTEL</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Add rooms</span>
          </a>
        </li>
        <li>
          <a href="viewstudent.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">View students</span>
          </a>
        </li>
        <li>
        <a href="adminroom.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">View Room</span>
          </a>
        </li>
        <li>

        <a href="admin_feedback.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Complaint</span>
          </a>
        </li>
        <li>

        <a href="logout.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Logout</span>
          </a>
        </li>
        <li>
  </div>

  <section class="home-section">
    <div class="container">
      <form action="" method="post">

      <label >ENTER THE ROOM NUMBER</label>
      <input type="text"  name="room" placeholder="Room no"  autocomplete="off"  >

      <label >ENTER THE PRICE</label>
      <input     type="number" min="10000" max="50000" step="10000" name="price"  placeholder="Price" autocomplete="off"   >
     
      <span class="validity"></span>

      <label >ENTER THE BLOCK NUMBER</label>
      <input type="text"  list="blockno" name="block" placeholder="Block No" autocomplete="off"  >

      <label>ENTER THE ROOM STATUS</label>
      <input type="text" list="mylist" name="status" autocomplete="off" placeholder="Status"  >

      <button type="submit" name="submit" class="btn btn-info">Submit</button>
      </form>
  </div>  
</section>
<datalist id="mylist">
   <option value="Sold" autocomplete="off">
   <option value="Unsold" autocomplete="off">
     </<datalist>
       
  



</body>


</html>