<?php 
include 'config.php';
session_start();
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == 'warden' and isset($password)){
		$sql = "SELECT * FROM warden WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			echo "<script type='text/javascript'>alert('Logged in Successfully');
			window.location='admin_landing.php';</script>";
			die;
		} else {
			echo "<script>alert('Woops! Username or Password is Wrong.')</script>";
		}
	}
	else{
		$sql = "SELECT * FROM student WHERE USN='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['s_id'] = $row['S_id'];
			echo "<script type='text/javascript'>alert('Logged in Successfully');
			window.location='student_landing.php';</script>";
			die;
		} else {
			echo "<script>alert('Woops! USN or Password is Wrong.')</script>";
		}
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
	<title>Login Page</title>
</head>
<body>
	<div class="container">
		<form action="" method="post" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" autocomplete="off" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
		</form>
		<h4>Are you a new student.? <a href="register.php" class="login">Register</a></h4>
	</div>
</body>
</html>