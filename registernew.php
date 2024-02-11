<?php
require 'config.php';
if ((isset($_POST['name'])) && (isset($_POST['passw']))) {
    // Collect post variables
    $username = $_POST['name'];
    $userpass = $_POST['passw'];
    $cpass= $_POST['passwc'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    if($userpass!=$cpass){
        echo '<script>alert("Your Passwords do not match");</script>';
    }
    else{
        $duplicate = mysqli_query($con, "SELECT * FROM `register` WHERE email = '$email' OR phone='$phone';");
        if (mysqli_num_rows($duplicate) > 0) {
            echo "<script> alert('User already exist enter a new email or phone number!!')</script>";
        } else {
            $sql = "INSERT INTO `register` (id, name, email, phone, address, age, password) VALUES (NULL, '$username', '$email' , '$phone', '$address', '$age', '$userpass');";
            // echo $sql;
            // Execute the query
            if (mysqli_query($con, $sql)) {
                // echo "Successfully inserted";
                // Flag for successful insertion
                $insert = true;
            } else {
                echo "ERROR: $sql <br> $con->error";
            }
        header("Location: userlogin.php");
        }

    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration system PHP and MySQL</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            /* box-sizing: border-box; */
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
            margin: 30px;
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

        .container form .input-box input:focus~.underline::after,
        .container form .input-box input:valid~.underline::after {
            transform: scaleX(1);
            transform-origin: left;
        }

		.container form .button {
			margin: 40px 0 20px 0;
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
        }

        .container form .input-box input{
            width: 100%;
            height: 100%;
            outline: none;
            font-size: 16px;
			background-color: white;
            border: none;
        }

        .container .input-box input[type="submit"] {
            background-color: #052659;
            font-size: 17px;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .container .input-box input[type="submit"]:hover {
            letter-spacing: 1px;
            background-color: #041a3a;
        }

        .container .option ,a,p{
            font-size: 14px;
            text-align: center;
            background-color: white;
            text-decoration: none;
            color: #052659;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="">
            <div class="title">
                <center>
                    <p>Registration</p>
                </center>
            </div>
            <div class="input-box underline">
                <input type="text" name="name" placeholder="Username" required>
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="number" placeholder="age" required name="age">
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="number" name="phone" placeholder="Phone Number" required>
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Address" required name="address">
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" required name="passw">
                <div class="underline"></div>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Confirm Password" required name="passwc">
                <div class="underline"></div>
            </div>
            <br>
            <div class="input-box button">
                <input type="submit" name="btn" value="Register">
            </div>
        </form>
        <div class="option">
        <a href="userlogin.php"><p>Already have an account?</p>
            Login</a>
        </div>
    </div>
</body>

</html>