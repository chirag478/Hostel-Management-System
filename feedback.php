<?php
    session_start();
    include 'config.php';
    $sid = $_SESSION["s_id"];
    if (isset($_POST['submit'])) {
      $feedback = $_POST['feedback'];
      $sql = "INSERT INTO feedback(feedback,date,S_id) VALUES ('$feedback',CURDATE(),$sid)";
      $result = mysqli_query($conn, $sql);
      if($result){
        echo "<script>alert('Complaint has been sent.')</script>";
        } else {
          echo "<script>alert('Woops! Something went wrong Wrong.')</script>";
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
          <a href="student_landing.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#" >
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
          <a href="#" class="active">
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
      </ul>
</div>

<div class="home-section">
    <form method="post" action="">
        <h2>Complaint</h2>
        <input type="text" class="form-control"  autocomplete="off"name="feedback">
        <br>
        <button class="btn btn-info" name="submit" >Submit</button>
    </form>

    <div class="container-fluid" style="padding-top: 40px;">
      <h3>Your Complaint</h3>
      <div class="row">
          <div class="col-md-12">
              <?php
              include("config.php");
              $sid = $_SESSION["s_id"];
              $sql = "SELECT * FROM feedback WHERE S_id = $sid";
              if($result = mysqli_query($conn, $sql)){
                  if(mysqli_num_rows($result) > 0){
                      echo '<table class="table table-bordered table-striped">';
                          echo "<thead>";
                              echo "<tr>";
                                  echo "<th>Feedback ID</th>";
                                  echo "<th>Feedback</th>";
                                  echo "<th>Date</th>";
                              echo "</tr>";
                          echo "</thead>";
                          echo "<tbody>";
                          while($row = mysqli_fetch_array($result)){
                              echo "<tr>";
                                  echo "<td>" . $row['F_id'] . "</td>";
                                  echo "<td>" . $row['feedback'] . "</td>";
                                  echo "<td>" . $row['date'] . "</td>";;
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
</div>
 
</body>
</html>