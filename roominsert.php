<?php
    session_start();
    include("config.php");
    $room_id = $_GET["id"];
    $id = $_SESSION["s_id"];
    $sql = "SELECT * FROM room WHERE S_id = $id";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<script type='text/javascript'>alert('You have already booked the room');
        window.location='room.php';</script>";
        die;
    }
    else{
        $sql = "UPDATE room SET S_id =$id,status = 'sold' WHERE R_id=$room_id";
        $result = mysqli_query($conn,$sql);
        if($result){
                echo "<script type='text/javascript'>alert('Room Booked Successfully');
                window.location='room.php';</script>";
                die;
        }
        else{
            echo "<script type='text/javascript'>alert('Error!!!!');
            window.location='room.php';</script>";
            die;
        }
    }
?>