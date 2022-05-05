<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/checkout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>

<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
         <div class="card-header p-4">
             <a class="pt-2 d-inline-block" href="transaction.php" data-abc="true">Home</a>
             <div class="float-right">
                 <h3 class="mb-0">Invoice #YD<?php echo(rand(1100,2000));?></h3>
                 Date: <?php echo(date("d-m-Y")); ?>
             </div>
         </div>
         <div class="card-body">
           <?php
             echo '<div class="table-responsive-sm">';
                 session_start();
                 $tid = $_GET["id"];
                 $remain = 0;
                 include("config.php");
                 $sql = "SELECT * FROM transaction WHERE T_id = $tid LIMIT 1";
                 $result = mysqli_query($conn,$sql);
                 if($result){
                        echo '<table class="table table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo '<th>Transaction ID</th>';
                                    echo '<th>Date</th>';
                                    echo '<th>Paid</th>';
                                echo '</tr>';
                                while($row = mysqli_fetch_array($result)){                            
                                    echo "<tr>";
                                        $remain = $row['remain'];
                                        echo '<td style="text-align:left;">'. $row["T_id"] . '</td>';
                                        echo '<td style="text-align:left;">' . $row["date"] . '</td>';
                                        echo '<td style="text-align:left;">' . $row["paid"] . '</td>';
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                            echo "</table>";
                    echo '</div>';
                    echo '<div class="row">';
                        echo '<div class="col-lg-7 col-sm-5">';
                        echo '</div>';
                        echo '<div class="col-lg-4 col-sm-1 ml-auto">';
                            echo '<table class="table table-clear">';
                                echo '<tbody>';
                                    echo '<tr>';
                                        echo '<td class="left">';
                                            echo '<strong class="text-dark">Remaining</strong> </td>';
                                        echo '<td class="right">';
                                            echo '<strong class="text-dark">' ."₹". $remain.' </strong>';
                                        echo '</td>';
                                    echo '</tr>';
                                echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                    echo '</div>';
                    mysqli_free_result($result);
                    }
            else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
            ?>
         </div>
     </div>
    <div style="padding-left: 700px;">
        <button onclick="window.print()"  class="btn btn-info">Print</button>
    </div>
 </div>

</body>
</html>