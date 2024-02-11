<?php
require 'config.php';


if (isset($_COOKIE['email'])) {
	$email = $_COOKIE['email'];
	$pass = $_COOKIE['password'];
	$id = $_COOKIE['id'];
	echo "Welcome back,$email, $pass,$id";
	$_SESSION["login"] = true;
	$_SESSION["id"] = $id;
	header("Location: userhomenew.php");

}

if ((isset($_POST['email'])) && (isset($_POST['passw']))) {
	$email = $_POST["email"];
	$password = $_POST["passw"];
	$result = mysqli_query($con, "SELECT * FROM `register` WHERE email = '$email';");
	$row = mysqli_fetch_assoc($result);
	if (mysqli_num_rows($result) > 0) {
		if (($password == $row["password"])) {
			if ($row["stat"] == '0') {
				echo "<script> alert('You yet to be validate!!Please try after some time');</script>";
			} else {
				$_SESSION["login"] = true;
				$_SESSION["id"] = $row["id"];
				$cookie_name1 = "email";
				$cookie_value1 = $email;
				$cookie_expiration1 = time() + 86400; // Cookie expires in 24 hours

				setcookie($cookie_name1, $cookie_value1, $cookie_expiration1, "/");

				$cookie_name2 = "password";
				$cookie_value2 = $password;
				$cookie_expiration2 = time() + 86400; // Cookie expires in 24 hours

				setcookie($cookie_name2, $cookie_value2, $cookie_expiration2, "/");

				$cookie_name3 = "id";
				$cookie_value3 = $row["id"];
				$cookie_expiration3 = time() + 86400; // Cookie expires in 24 hours

				setcookie($cookie_name3, $cookie_value3, $cookie_expiration3, "/");

				header("Location: userhomenew.php");
			}
		} else {
			echo "<script> alert('Wrong password');</script>";
		}
	} else {
		echo "<script> alert('User does not exist');</script>";
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<style>
		@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
		@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: "Poppins", sans-serif;
			background-color: #C1E8FF;
		}

		html,
		body {
			display: grid;
			height: 100vh;
			width: 100%;
			place-items: center;
		}

		form {
			background-color: white;

		}

		.container {
			background-color: #fff;
			max-width: 350px;
			width: 100%;
			padding: 25px 30px;
			border-radius: 5px;
			box-shadow: 0 10px 10px rgba(0, 0, 0, 0.15);
		}

		.container form .title {
			margin: 20px 0 10px 0;

		}

		.container form .title p {
			background-color: white;
			font-size: 25px;
			color: #052659;
		}

		.container form .input-box {
			width: 100%;
			height: 45px;
			margin-top: 25px;
			position: relative;
			background-color: white;
		}

		.container form .input-box input {
			width: 100%;
			height: 100%;
			outline: none;
			font-size: 16px;
			border: none;
			background-color: white;
			color: #514d4d;
		}

		.container form .underline::before {
			content: "";
			position: absolute;
			height: 2px;
			width: 100%;
			background: #ccc;
			left: 0;
			bottom: 0;
		}

		.container form .underline::after {
			content: "";
			position: absolute;
			height: 2px;
			width: 100%;
			background: #052659;
			left: 0;
			bottom: 0;
			transform: scaleX(0);
			transform-origin: left;
			transition: all 0.3s ease;
		}

		.container form .input-box input:focus~.underline::after {
			transform: scaleX(1);
			transform-origin: left;
		}

		.container form .button {
			margin: 40px 0 20px 0;
		}

		.container .input-box input[type="submit"],
		.btn,
		.btn a {
			background-color: #052659;
			font-size: 17px;
			color: #fff;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.container .input-box input[type="submit"]:hover,
		.btn:hover {
			letter-spacing: 1px;
			background-color: #041a3a;
		}

		.btn a:hover {
			letter-spacing: 1px;
			background-color: #041a3a;
		}

		.container .option {
			font-size: 14px;
			text-align: center;
		}

		.Forget {
			font-family: sans-serif;
			text-decoration: none;
			color: #3b3838;
		}

		.btn {
			background-color: #052659;
			font-size: 17px;
			color: #fff;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
			width: 100%;
			border: none;
			height: 100%;
		}

		.btn a {
			color: #fff;
			text-decoration: none;
			background-color: transparent;
		}

		.option,
		p,
		a {
			color: #052659;
			background-color: white;
			text-decoration: none;
		}
	</style>
</head>

<body>
	<div class="container">
		<!-- user login -->
		<form method="post" action="" class="user-login-form">
			<div class="title">
				<center>
					<p>User Login</p>
				</center>
			</div>
			<div class="input-box">
				<input type="email" placeholder="Email" name="email">
				<div class="underline"></div>
			</div>
			<div class="input-box">
				<input type="password" placeholder="Password" name="passw">
				<div class="underline"></div>
			</div>
			<br>
			<div class="input-box button">
				<input type="submit" name="login_user" value="Login" />
			</div>

			<div class="input-box button">
				<button class="btn"><a href="./adminloginnew.php">Login as Admin </a></button>
			</div>

			<div class="option">
				<a href="registernew.php">
					<p>Don't have account?</p>
					Create New
				</a>
			</div>
		</form>
</body>

</html>