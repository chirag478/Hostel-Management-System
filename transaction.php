<?php
    session_start();
    include 'config.php';
    $sid = $_SESSION["s_id"];
    $sql = "SELECT price FROM room WHERE room.S_id = $sid";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $total = $row["price"];
        if (isset($_POST['pay'])) {
        $paid = $_POST['amount'];
        try{
            if($paid == 0){
                throw new exception ("Pay above 0");
            }
            else{
                $sql = "SELECT S_id FROM transaction WHERE S_id = $sid";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    if($paid > 0){
                        $sql1 = "SELECT remain FROM transaction WHERE S_id = $sid ORDER BY T_id DESC LIMIT 1";
                        $result1 = mysqli_query($conn,$sql1);
                        while($row = mysqli_fetch_array($result1)){
                            $remain_inside = $row['remain'];
                        }
                        if($remain_inside>0){
                            $remain_inside = $remain_inside-$paid;
                            if($remain_inside>=0){
                                $sql2 = "INSERT INTO transaction(date,paid,remain,S_id) VALUES (CURDATE(),'$paid','$remain_inside',$sid)";
                                $result2 = mysqli_query($conn,$sql2);
                                if($result2){
                                    echo "<script>alert('Value Added Successfully')</script>";
                                }
                                else{
                                    echo "<script>alert('Error in adding value')</script>";
                                }
                            }
                            else{
                                echo "<script>alert('Paying too high value')</script>";
                            }
                        }
                        else{
                            echo "<script>alert('All Amount paid Successfully')</script>";
                        }
                    }
                }
                else{
                    $total = $total - $paid;
                    if($total >= 0){
                       $sql = "INSERT INTO transaction(date,paid,remain,S_id) VALUES (CURDATE(),'$paid','$total',$sid)";
                       $result = mysqli_query($conn,$sql);
                       echo "<script>alert('Value Added Successfully')</script>";
                    }
                    else{
                       echo "<script>alert('Value is too High')</script>";
                    }
                }
            }
        }
        catch(Exception $e){
            echo "<script type='text/javascript'>alert('{$e->getMessage()}');
            window.location='transaction.php';</script>";
            die;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/admin style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>

  
    </style>
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">My Profile</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="student_landing.php" >
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
        <a href="#"class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Transaction</span>
          </a>
        </li>
        <li>
          <a href="feedback.php">
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
        <div class="container-fluid">
            <div class="row">
                <h3>Room Booked</h3>
                <div class="col-md-12">
                    <?php
                    include("config.php");
                    $sid = $_SESSION["s_id"];
                    $sql = "SELECT * FROM student,room WHERE room.S_id=student.S_id AND student.S_id= $sid";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Name</th>";
                                        echo "<th>Room No</th>";
                                        echo "<th>Block No</th>";
                                        echo "<th>Price</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    $remain = $row["price"];
                                    echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['room_no'] . "</td>";
                                        echo "<td>" . $row['block_no'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            </div>        
        </div>
    <?php
    $sql = "SELECT * FROM room WHERE S_id = $sid";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '<div style="padding-top: 40px;">';
            echo '<form action="" method="post">';
                echo '<h4>Pay Here</h4>';
                echo '<input type="text" name="amount" style="width:40%;" placeholder="Enter the Amount" autocomplete="off">';
                echo '<br>';
                echo '<button class="btn btn-info" name="pay">Pay</button>';
            echo '</form>';
        echo '</div>';
    }
    ?>

    <div class="container-fluid" style="padding-top: 40px;">
        <div class="row">
            <h3>Transaction</h3>
              <div class="col-md-12">
                  <?php
                  include("config.php");
                  $sid = $_SESSION["s_id"];
                  $sql = "SELECT * FROM transaction WHERE S_id = $sid ";
                  if($result = mysqli_query($conn, $sql)){
                      if(mysqli_num_rows($result) > 0){
                          echo '<table class="table table-bordered table-striped">';
                              echo "<thead>";
                                  echo "<tr>";
                                      echo "<th>T ID</th>";
                                      echo "<th>Paid</th>";
                                      echo "<th>Remaining</th>";
                                      echo "<th>Date</th>";
                                      echo "<th>Action</th>";
                                  echo "</tr>";
                              echo "</thead>";
                              echo "<tbody>";
                              while($row = mysqli_fetch_array($result)){
                                  echo "<tr>";
                                      echo "<td>" . $row['T_id'] . "</td>";
                                      echo "<td>" . $row['paid'] . "</td>";
                                      echo "<td>" . $row['remain'] . "</td>";
                                      echo "<td>" . $row['date'] . "</td>";
                                      echo "<td>";
                                            echo '<a href="checkout.php?id='. $row['T_id'] .'"  class="btn btn-info btn-sm">Checkout</a>';
                                      echo "</td>";
                                  echo "</tr>";
                              }
                              echo "</tbody>";                            
                          echo "</table>";
                          mysqli_free_result($result);
                      } else{
                          echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                      }
                  } else{
                      echo "Oops! Something went wrong. Please try again later.";
                  }
                  ?>
              </div>
          </div>        
        </div>
</section>

</body>
</html>