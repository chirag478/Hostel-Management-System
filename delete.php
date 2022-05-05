<?php
session_start();
include("config.php");
$roomid = $_GET["id"];
global $sid;
$sql = "SELECT S_id FROM room WHERE R_id = $roomid";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)){
    $sid = $row['S_id'];
}
$sql1 = "DELETE FROM room WHERE R_id = $roomid";
if (mysqli_query($conn,$sql1)) {
    echo "<script type='text/javascript'>alert('Deleted successfully');
    window.location='adminroom.php';</script>";
    die;
} else{
    echo "<script type='text/javascript'>alert('Something Wrong');
    window.location='adminroom.php';</script>";
    die;
}
mysqli_close($conn);
?>