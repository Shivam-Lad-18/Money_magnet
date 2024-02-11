<?php include("config.php");
if ((isset($_SESSION["id"]))) {
    $id = $_SESSION["id"];
    $result = mysqli_query($con, "SELECT * FROM `register` WHERE id = '$id';");
    $row = mysqli_fetch_assoc($result);
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $age = $row["age"];
    $balance = $row["balance"];
    $lastdepo = $row["lastdepo"];
    $amt = "₹ " . $balance;
    $total = 0;
    $result1 = mysqli_query($con, " SELECT `amount` FROM `data` WHERE 1 ");
    while ($row = mysqli_fetch_array($result1)) {
        $total = $row["amount"];
    }
    $totalstr = "₹ " . $total;
    $date = gmdate("Y-n-j");
    $date2 = new DateTime($date);
    // echo $date;
    $date3 = new DateTime($lastdepo);
    $interval = $date2->diff($date3);
}
else{
	header("Location: userlogin.php");
    
}
?>


<?php

if (isset($_POST['deposit'])) {
    $balance += 100;
    $result = mysqli_query($con, "UPDATE `register` SET `balance`='$balance',`lastdepo`='$date' WHERE id=$id");
    mysqli_query($con, "INSERT INTO `deposits`(id, amount, date) VALUES ('$id','100','$date')");
    $result = mysqli_query($con, "SELECT * FROM `data` WHERE 1");
    $row1 = mysqli_fetch_assoc($result);
    $t2 = $row1["amount"];
    $t3 = $t2 + 100;
    $result = mysqli_query($con, "UPDATE `data` SET `amount`='$t3' WHERE 1");
    header("location:payment.php");
}
?>


<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Preahvihear&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">

<head>
<title>Money Magnet</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            /* box-sizing: inherit; */
        }

        html {
            font-size: 62%;
            /* box-sizing: border-box; */
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            color: #444;
            line-height: 1.9;
            background-color: #C1E8FF;
        }

        .name {
            background-color: #367cdf;
            position: fixed;
            top: 0;
            padding: 15px 20px 20px 10px;
            border-radius: 0px 0px 50px 0px;
            box-shadow: 0px 0px 10px black;
            font-family: Preahvihear;
        }

        .sty {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sty h1 {
            font-size: xx-large;
            color: white;

        }

        .bgimg {
            height: 100vh;
            width: 100vw;
        }

        .bg {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 390px;
            margin-top: 30px;
            margin-right: 50px;
            gap: 30px;

        }

        .bg .box {
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 20px;
            border-radius: 30px 30px 0px 0px;
            /* height: 20px; */
            /* box-shadow: 0px 0px 10px black; */
            box-shadow: 0 -10px 10px -15px rgba(0, 0, 0, 1), -10px 0 10px -10px rgba(0, 0, 0, 0.5), 10px 0 10px -10px rgba(0, 0, 0, 0.5);

        }

        .deposit {
            border-bottom: 15px solid #367cdf;
        }

        .home,
        .loan,.history {
            border-bottom: 15px solid #d2d7dd;
        }

        .box:hover {
            background-color: #367cdf;
            cursor: pointer;
            border-bottom: 15px solid #367cdf;
        }

        .imghvr,
        .imghvr1,.imghvr2 {
            display: none;
        }

        .deposit {
            background-color: #367cdf;
        }

        .box img {
            height: 35px;
        }

        .home,
        .loan,.history {
            background-color: #d2d7dd;
        }

        @property --num {
            syntax: '<integer>';
            inherits: true;
            initial-value: 0;
        }

        @keyframes count {
            to {
                --num: <?= $total ?>;
            }
        }

        .counter::before {
            counter-reset: my-counter var(--num);
            content: counter(my-counter);
            animation: count 5s ease-in-out forwards;
        }

        .counter,
        .sign,
        .counter2 {
            color: #008000;
            font-weight: 700;
            font-size: 21px;
        }

        .moneycount {
            display: block;
            position: fixed;
            min-width: 230px;
            top: 82%;
            left: 78%;
            padding: 20px;
            border-radius: 10PX;
            box-shadow: 0px 0px 10px 0.5px black;
            background-color: #d2d7dd;
        }

        .bal {
            font-size: 19px;
            font-weight: 500;
            color: #052659;
        }

        .page {
            width: 94%;
            height: fit-content;
            background-color: #367cdf;
            margin: 0px 30px 0px 10px;
            border-radius: 30px;
            box-shadow: 0px 0px 10px black;
            padding: 30px;
            display: flex;
            justify-content: space-around;
            /* align-items: center; */
        }

        .fot {
            padding-left: 10px;
            padding-right: 10px;
        }

        .footer {
            background: #367cdf;
            padding: 30px 0px;
            font-family: 'Play', sans-serif;
            text-align: center;
            font-size: 15px;
            width: 100%;
            margin-top: 50px;
            border-radius: 30px 30px 0px 0px;
            box-shadow: 0px 0px 10px black;
        }

        .footer .row {
            width: 100%;
            margin: 1% 0%;
            padding: 0.6% 0%;
            color: white;
            font-size: 0.8em;
        }

        .footer .row a {
            text-decoration: none;
            color: white;
            transition: 0.5s;
        }

        .footer .row a:hover {
            color: #052659;
            letter-spacing: 1px;
        }

        .footer .row ul {
            width: 100%;
        }

        .footer .row ul li {
            display: inline-block;
            margin: 0px 30px;
        }

        .footer .row a i {
            font-size: 2em;
            margin: 0% 1%;
        }

        @media (max-width:720px) {
            .footer {
                text-align: left;
                padding: 5%;
            }

            .footer .row ul li {
                display: block;
                margin: 10px 0px;
                text-align: left;
            }

            .footer .row a i {
                margin: 0% 3%;
            }
        }

        .card {
            display: inline-block;
            width: 40%;
            /* aspect-ratio: 1; */
            background-color: #d2d7dd;
            --m:
                conic-gradient(from -45deg at bottom, #0000, #000 1deg 89deg, #0000 90deg) bottom/10px 51% repeat-x,
                conic-gradient(from 135deg at top, #0000, #000 1deg 89deg, #0000 90deg) top /10px 51% repeat-x;
            -webkit-mask: var(--m);
            mask: var(--m);
        }

        .detail {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            font-family: monospace;
            font-size: 14px;
            margin: 20px 10px;

        }

        .money {
            font-size: 40px;
        }

        .info {
            text-align: left;
            width: 80%;
            margin: 20px 0px;
            font-size: 15px;
        }

        .font .none {
            display: none;
        }

        .paid {
            margin: 30px;
            font-size: 20px;
            color: #d2d7dd;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: relative;
            padding: 10px 30px;
            background: #367cdf;
            color: #d2d7dd;
            margin: 10px;
            border: 0;
            font-size: 15px;
            border-top-right-radius: 20px;
            border-bottom-left-radius: 20px;
            transition: all 0.5s;

            &:hover {
                border-top-right-radius: 0px;
                border-bottom-left-radius: 0px;
                transform: scale(1.1);

                &:before,
                &:after {

                    width: 100%;
                    height: 100%;
                }
            }
        }

        .data-container {
            /* background: #ffebee; */
            /* height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .button {
            background: transparent;
            border: 0;
            padding: 10px 30px;
            font-size: 16px;
            color: #d2d7dd;
        }
    </style>
</head>

<body>
    <div class="name" id="navbar">
        <div class="sty">
            <img src="logo1.png" alt="logo" height="50px">
            <h1>Money<span style="color:#8CF088;"> Magnet</span></h2>
                <h1></h1>
        </div>
    </div>

    <script>
        let prevScrollPos = window.pageYOffset;
        window.onscroll = function() {
            const currentScrollPos = window.pageYOffset;
            console.log("curr" + currentScrollPos);
            console.log("prev" + prevScrollPos);
            if (currentScrollPos > 20) {
                document.getElementById("navbar").style.opacity = 0;
            } else {
                document.getElementById("navbar").style.opacity = 1; /* Adjust the height of your navbar */
            }
            prevScrollPos = currentScrollPos;
        };
    </script>

    <div class="bg">
        <a class="home box" href="userhomenew.php"> <img class="orgimg" src="home-black.png" alt=""> <img class="imghvr" class="imghvr" src="home-white.png" alt=""> </a>
        <a class="deposit box" href="userdepo.php"><img src="depo-white.png" alt=""></a>
        <a class="loan box" href="userloannew.php"><img class="orgimg1" src="loan-black.png" alt=""> <img class="imghvr1" src="loan-white.png" alt=""></a>
        <a class="history box" href="userhistory.php"><img class="orgimg2" src="history-black.png" alt=""> <img class="imghvr2" src="history-white.png" alt=""></a>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const triggerDiv = document.querySelector('.home');
            const triggerDiv2 = document.querySelector('.loan');
            const triggerDiv3 = document.querySelector('.history');
            const targetDiv1 = document.querySelector('.imghvr');
            const targetDiv2 = document.querySelector('.orgimg');
            const targetDiv11 = document.querySelector('.imghvr1');
            const targetDiv22 = document.querySelector('.orgimg1');
            const targetDiv111 = document.querySelector('.imghvr2');
            const targetDiv222 = document.querySelector('.orgimg2');

            triggerDiv.addEventListener('mouseover', function() {
                targetDiv1.style.display = 'block';
                targetDiv2.style.display = 'none';
            });

            triggerDiv.addEventListener('mouseout', function() {
                targetDiv1.style.display = 'none';
                targetDiv2.style.display = 'block';
            });

            triggerDiv2.addEventListener('mouseover', function() {
                targetDiv11.style.display = 'block';
                targetDiv22.style.display = 'none';
            });

            triggerDiv2.addEventListener('mouseout', function() {
                targetDiv11.style.display = 'none';
                targetDiv22.style.display = 'block';
            });
            triggerDiv3.addEventListener('mouseover', function() {
                targetDiv111.style.display = 'block';
                targetDiv222.style.display = 'none';
            });

            triggerDiv3.addEventListener('mouseout', function() {
                targetDiv111.style.display = 'none';
                targetDiv222.style.display = 'block';
            });
        });
    </script>
    <div class="moneycount">
        <h1 style="display: flex;align-items: center;"> <img src="fund.png" height="25px" alt=""> &nbsp; <span class="bal">Total Fund: &nbsp;</span> <span class="sign">₹</span><span class="counter"></span></h1>
    </div>

    <div class="page">
        <?php

        // $diff = date_diff($date3, $date2);
        if ($interval->m >= "1" || $interval->y >= "1") { ?>
            <div class="card">
                <div class="detail">
                    <h1>Monthly Deposit</h1>
                    <hr style="width: 85%; background-color: #444; color: #444; height: 2px; border: 0;">
                    <p class="money">
                        ₹100
                    </p>
                    <hr style="width: 85%; background-color: #444; color: #444; height: 2px; border: 0;">
                    <div class="info">
                        <div>Today's Date : <span id="currentDate" style="float: right;"></span></div>
                        <div>Last deposit date :<span style="float: right;"><?= $lastdepo ?> </span></div>
                        <div>Deposit Amount : <span style="float: right;">₹100</span></div>
                    </div>
                    <hr style="width: 85%; background-color: #444; color: #444; height: 2px; border: 0;">
                    <div style="width: 100%; ">
                        <div style="font-size: 20px;margin:0px 40px;float:right"><b>Sub Total : ₹100</b></div>
                    </div>
                    <form method="POST" class="font" action="payment.php">
                        <div class="none">
                            <label for="amount"> Amount : </label>
                            <input type="number" value="100" name="amount" disabled>
                            <label for="amount"> Date : </label>
                            <input type="date" name="date" id="date12" disabled>
                        </div>

                        <div class="data-container">

                            <input type="submit" class="btn" name="deposit" value="Pay">
                        </div>
                    </form>
                    <script>
                        // JavaScript code to get and display the current date
                        var currentDateElement = document.getElementById("currentDate");
                        var currentDate = new Date();
                        var year = currentDate.getFullYear();
                        var month = currentDate.getMonth() + 1; // Month is zero-indexed, so we add 1
                        var day = currentDate.getDate();

                        // Format the date as YYYY-MM-DD
                        var formattedDate = (day < 10 ? "0" : "") + day + "/" + (month < 10 ? "0" : "") + month + "/" + year;

                        // Display the formatted date
                        currentDateElement.textContent = formattedDate;
                    </script>
                </div>
            </div>
        <?php

        } else { ?>
            <div class="paid">
                <h2>You have already paid your monthly deposit</h2>
                <img src="greentick.png" height="100px">
                <p>Last deposit date : <?= $lastdepo ?> </p>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="fot">
        <footer>
            <div class="footer">
                <div class="row">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                </div>

                <div class="row">
                    <ul>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Career</a></li>
                    </ul>
                </div>

                <div class="row">
                    MoneyMagnet Copyright © 2023 MM - All rights reserved || Designed By: Shivam
                </div>
            </div>
        </footer>
    </div>


    <script>
        document.getElementById('date12').valueAsDate = new Date();
    </script>
</body>

</html>