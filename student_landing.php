<?php 
session_start();
require_once "config.php";
$sid = $_SESSION["s_id"];
$sql = "SELECT * FROM student WHERE S_id = $sid";
$result = mysqli_query($conn,$sql);
if($result){
  while($row = mysqli_fetch_array($result)){
    $sid = $row['S_id'];
    $usn = $row['USN'];
    $sname = $row['name'];
    $age = $row['age'];
    $gender = $row['gender'];
    $address = $row['address'];
    $phone = $row['phone'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/admin style.css">
    <link rel="stylesheet" href="/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>

<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">My Profile</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="room.php" >
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Room</span>
          </a>
        </li>
        <li>
        <a href="transaction.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Transaction</span>
          </a>
        </li>
        <li>
          <a href="feedback.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Complaints</span>
          </a>
        </li>
        <li>
        <a href="logout.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Logout</span>
          </a>
        </li>
      </ul>
</div>

<section class="home-section">
    
    <div class="jumbotron h5" style="padding-left:100px;">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $sname?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Student ID</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $sid?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">USN</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $usn?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Age</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $age?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Gender</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $gender?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Address</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $address?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Phone</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $phone?></p>
              </div>
            </div> 
    </div>
  </section>
 
  
</body>
</html>