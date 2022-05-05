<div class="home-section">
        <div class="container-fluid">
            <?php
            require_once "config.php";
            if(isset($_POST["pay"])){
                $val = $_POST["amount"];
                $sql = "SELECT sid FROM transaction WHERE sid = '$id'";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    if($val > 0 and $remain>=0){
                        $sql1 = "SELECT remain FROM transaction WHERE sid = $id LIMIT 1";
                        $result1 = mysqli_query($conn,$sql1);
                        while($row = mysqli_fetch_array($result1)){
                            $remain_inside = $row["remain"];
                        }
                        $remain_inside = $remain_inside-$val;
                        $sql2 = "INSERT INTO transaction(tdate,paid,remain,sid) VALUES (CURDATE(),$val,$remain_inside,$id)";
                        $result2 = mysqli_query($conn,$sql2);
                        if($result2){
                            echo "<script>alert('Value Added Successfully')</script>";
                        }
                        else{
                            echo "<script>alert('Error in adding value')</script>";
                        }
                    }
                    else{
                        echo "<script>alert('All amount is paid')</script>";
                    }
                }
                else{
                    $remain = $remain - $val;
                    $sql = "INSERT INTO transaction(tdate,paid,remain,sid) VALUES (CURDATE(),$val,$remain,$id)";
                    $result = mysqli_query($conn,$sql);
                }
            }
            $sql1 = "SELECT * FROM transaction,student WHERE student.st_id=$id
                            AND student.st_id = transaction.sid";
            $result1 = mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1) > 0){
                    echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>T ID</th>";
                                echo "<th>Name</th>";
                                echo "<th>Paid</th>";
                                echo "<th>Remaining</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result1)){
                            echo "<tr>";
                                echo "<td>" . $row['t_id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row["paid"] . "</td>";
                                echo "<td>" . $row['remain'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";                            
                    echo "</table>";
                    mysqli_free_result($result1);
                } 
            else{
                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                }
            mysqli_close($conn);
            ?>    
            </div>   