<?php 
include 'config.php';
session_start();
if (isset($_POST['submit'])) {
	$fullname = $_POST['fullname'];
	$usn=$_POST['usn'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	if ($password == $cpassword) {
		$sql = "INSERT INTO student(name,USN,age,gender,address, phone, password) VALUES 
				('$fullname','$usn','$age','$gender','$address','$phone','$password')";
		$result = mysqli_query($conn, $sql);
		$sid = mysqli_insert_id($conn);
		$_SESSION['s_id'] = $sid;
		if ($result) {
			echo "<script type='text/javascript'>alert('New Account created successfully');
			window.location='student_landing.php';</script>";
			die;
		}
		else{
			echo "<script>alert('Woops! Something Wrong Went.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/admin style.css">
	<title>Register Page</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Full Name" name="fullname" autocomplete="off" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="USN" name="usn" autocomplete="off" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Age" name="age" autocomplete="off" required>
            </div>
			<div class="input-group">

			<input type="search" list="mylist" placeholder="Gender" name="gender" autocomplete="off" required> 

  </select>
            </div>
            <div class="input-group">
				<input type="text" placeholder="Address" name="address"  autocomplete="off"required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Phone" name="phone"autocomplete="off" pattern="[0-9]{10}" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
			</div>
			<small>Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters</small>			
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<h4>Not a fresher?<a href="index.php" class="login-register-text">Login Here</a></h4>
		</form>
	</div>
	<datalist id="mylist">
   <option value="Male">
   <option value="Female">
   <option value="Others">
</datalist>
</body>
</html>