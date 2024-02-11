<?php
require 'config.php';
if ((isset($_POST['addid'])) && (isset($_POST['addpass']))) {
    $addminid = $_POST["addid"];
    $addpassword = $_POST["addpass"];
    $result = mysqli_query($con, "SELECT * FROM `admin` WHERE adminid = '$addminid';");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($addpassword == $row["password"]) {
			session_start();
			$_SESSION["adminname"]=$addminid;
			$_SESSION["mail"]=false;
            header("Location: adminhomenew.php");
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
			background: #fff;
			max-width: 350px;
			width: 100%;
			padding: 25px 30px;
			border-radius: 5px;
			box-shadow: 0 10px 10px rgba(0, 0, 0, 0.15);
		}
		h1{
			padding: 5px;
            padding-left: 30px;
            background-color: #367cdf;
            color: #ffffff;
            border-radius: 0px 50px 50px 0px;
            width: 600px;
			margin-left: 5px;
		}
		.container form .title {
			margin: 20px 0 10px 0;
		}


		.container form .title p {
			font-size: 25px;
			background-color: white;
			text-align: center;
			color: #052659;

		}

		.container form .input-box {
			width: 100%;
			height: 45px;
			margin-top: 25px;
			position: relative;
		}

		.container form .input-box input {
			width: 100%;
			height: 100%;
			outline: none;
			font-size: 16px;
			border: none;
			background-color: white;
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
			background:#052659;
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
		.container form .title {
            margin: 20px 0 10px 0;
        }
		.container .input-box input[type="submit"], .btn,.btn a{
			background-color: #052659;
			font-size: 17px;
			color: #fff;
			border-radius: 5px;
			cursor: pointer;
			transition: all 0.3s ease;
		}

		.container .input-box input[type="submit"]:hover,.btn:hover {
			letter-spacing: 1px;
			background-color: #041a3a;

		}
		.btn a:hover {
			letter-spacing: 1px;
			background-color:#041a3a;
		}
		.btn {
			background-color:#052659;
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
	</style>

</head>

<body>

	<div class="container">

		<!-- user login -->
		<form method="post" action="" class="user-login-form">
			<div class="title">
				<p>Admin Login</p>
			</div>

			
			<div class="input-box underline">
				<input type="text" placeholder="Admin Id" name="addid">
				<div class="underline"></div>
			</div>
			<div class="input-box">
				<input type="password" placeholder="Password" name="addpass">
				<div class="underline"></div>
			</div>
			<br>
			<div class="input-box">
				<input type="submit" name="login_user" value="Login" />
			</div>
			<div class="input-box btn">
			<button class="btn"><a href="userlogin.php">Login as User</a></button>
			</div>
			

		</form>

</body>

</html>