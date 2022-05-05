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
      <span class="logo_name">HOSTEL</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="admin_landing.php" >
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
        <a href="#"class="active">
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

<div class="home-section" ">
        <div class="container-fluid">
            <h3>Rooms in Hostel</h3>
            <div class="row">
                <div class="col-md-12">
                    <?php
                    session_start();
                    include("config.php");
                    $sql = "SELECT * FROM room";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Room No</th>";
                                        echo "<th>Block No</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Status</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['room_no'] . "</td>";
                                        echo "<td>" . $row['block_no'] . "</td>";
                                        echo "<td>" . $row['price'] . "</td>";
                                        echo "<td>"  . strtoupper($row['status']) . "</td>";
                                        echo "<td>";
                                        echo '<div class="btn-group">';
                                        if($row['status']=='unsold'){
                                            echo '<a href="update.php?id='. $row['R_id'] .'"  class="btn btn-info btn-sm">Update</a>';
                                            echo '<a href="delete.php?id='. $row['R_id'] .'"  class="btn btn-info btn-sm">Delete</a>';
                                        } else{
                                            echo '<a href="delete.php?id='. $row['R_id'] .'"  class="btn btn-info btn-sm">Delete</a>';
                                        }
                                        echo '</div>';
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
</div>
    


